<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\PlanPrice;
use App\Models\Guest;
use App\Mail\ReservationCreateMail;
use App\Http\Requests\ReservationController\ConfirmRequest;
use Carbon\Carbon;

class GuestReservationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PlanPrice $planPriceDate)
    {
        // チェックアウト日のデフォルト値を設定(チェックイン日の翌日)
        $startDate = Carbon::createFromDate($planPriceDate->reservationSlot->reservation_slot_date)->toDateString();
        $defaultEndDate = Carbon::parse($startDate)->addDay(1)->toDateString();

        // もし、すでにsessionに予約者情報があれば取得する
        if( session()->has('guestData') ) {
            $guestData = session()->get('guestData');
        } else {
            $guestData = '';
        }

        // dd($planPriceDate); PlanPriceモデルのインスタンスが入っている
        return view('reservations.create', [
            'planPriceDate' => $planPriceDate,
            'defaultEndDate' => $defaultEndDate,
            'guestData' => $guestData,
        ]);
    }

    /**
     * 宿泊者情報の一時保存と確認画面への遷移
     *
     * @return \Illuminate\Http\Response
     */
    public function createConfirm(ConfirmRequest $request, PlanPrice $planPriceDate)
    {
        // 送信された内容をセッションに保存
        $request->session()->put('guestData', $request->all());

        // dd($planPriceDate);

        return to_route('reservation.show_confirm', [
            'planPriceDate' => $planPriceDate->id,
        ]);
    }

    /**
     * 確認画面表示
     *
     */
    public function showConfirm(PlanPrice $planPriceDate)
    {
        // $planPriceDate createから受け取ったplanPriceDateのデータが入っている
        // セッションからデータを取得
        $guestData = session()->get('guestData');
        // dd($guestData);

        // セッションが空の場合は予約画面に遷移
        if (empty($guestData)) {
            return redirect()->route('reservation.create', [
                'planPriceDate' => $planPriceDate,
            ]);
        }

        // セッションにデータがある場合は確認画面を表示
        return view('reservations.confirm', [
            'guestData' => $guestData,
            'planPriceDate' => $planPriceDate,
        ]);
    }

    /**
     * 確認画面から予約画面へ戻る
     *
     * @return \Illuminate\Http\Response
     */
    public function backToCreate(PlanPrice $planPriceDate)
    {
        // セッションから顧客情報入力データを取得
        $guestData = session()->get('guestData');

        // 予約画面に遷移
        return view('reservations.create', compact('planPriceDate', 'guestData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PlanPrice $planPriceDate)
    {
        // セッションから顧客情報入力データを取得
        $guestData = session()->get('guestData');
        // チェックイン日とチェックアウト日の日付を取得
        $checkInDate = $planPriceDate->reservationSlot->reservation_slot_date;
        // dd($checkInDate);
        $checkOutDate = $guestData['end_date'];

        // チェックイン日とチェックアウト日の日付をCarbonインスタンスに変換
        $checkInDay = new Carbon($checkInDate);
        $checkOutDay = new Carbon($checkOutDate);

        // チャックアウト日がチェックイン日の翌日だった場合
        if( $checkOutDay == $checkInDay->copy()->addDay() ) {
            // 宿泊者情報を保存
            $guest = Guest::create([
                'name' => $guestData['name'],
                'email' => $guestData['email'],
                'tel' => $guestData['tel'],
                'address' => $guestData['address'],
            ]);
            // 予約を作成
            $reservation = $planPriceDate->reservations()->create([
                'plan_price_id' => $planPriceDate->id,
                'guest_id' => $guest->id,
                'memo' => '',
                'cancel_at' => 0,
            ]);
        } else {
            // dd('チェックアウト日がチェックイン日の翌日以降だった場合');

            // 予約フォームから送信されたチェックアウト日をCarbonインスタンスに変換
            $checkOutDay = new Carbon($guestData['end_date']);

            // チャックアウト日がチェックイン日の翌日以降だった場合
            // reservation(予約)をチェックイン日とチャックアウト日までの各PlanPriceに紐ずくreservation(予約)を作成する
            // チェックイン日とチャックアント日の日付・部屋タイプ・プランIDが一致するplanPriceを取得
            $planPrices = PlanPrice::whereRelation('reservationSlot', 'reservation_slot_date', '>=', $checkInDate)
                                    ->whereRelation('reservationSlot', 'reservation_slot_date', '<=', $checkOutDay)
                                    ->whereRelation('reservationSlot.room', 'type', $planPriceDate->reservationSlot->room->type)
                                    ->whereRelation('plan', 'id', $planPriceDate->plan_id)
                                    ->get();
            dd($planPrices);

        }

        // reservation(予約)をチェックイン日のみ作成する


        // チャックアウト日がチェックイン日の翌日以降だった場合
        // reservation(予約)をチェックイン日とチャックアウト日までの各PlanPriceに紐ずくreservation(予約)を作成する

        // チェックイン日とチャックアント日の日付・部屋タイプ・プランIDが一致する予約枠を取得



        // 予約完了後にメールを送信する
        // \Mail::to($guestData['email'])->send(new ReservationCreateMail($reservation));
        // \Mail::to('tm.274795@gmail.com')->send(new ReservationCreateMail($reservation));


        return redirect()->route('top')->with('flash_message', '予約が確定されました。');
    }

}
