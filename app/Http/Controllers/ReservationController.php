<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\PlanPrice;
use App\Http\Requests\ReservationController\ConfirmRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PlanPrice $planPriceDate)
    {
        // dd($planPriceDate);
        // 新規作成画面で必要なデータ
        // planPriceの部屋タイプと予約枠日時とプラン名が$planPriceと同じである予約枠の宿泊料金プラン(planPrice)を取得する
        // $date = $planPriceDate->reservationSlot->reservation_slot_date;
        // $roomType = $planPriceDate->reservationSlot->room->type;
        // dd($date, $roomType);
        // $planPrices = PlanPrice::where('plan_id', $planPriceDate->plan_id)
        //                 ->whereHas('reservationSlot', function($query) use($roomType, $date) {
        //                     $query->where('reservation_slot_date', '=', $date);
        //                     $query->whereHas('room', function($query) use($roomType, $date) {
        //                         $query->where('type', '=', $roomType);
        //                     });
        //                 })->get();
        // dd($planPrices);

        // 部屋番号を取得する
        // foreach($planPrices as $planPrice){
        //     $rooms[] = $planPrice->reservationSlot->room;
        // }
        // dd($rooms);

        // チェックイン日を取得する
        // $startDate = Carbon::createFromDate($planPriceDate->reservationSlot->reservation_slot_date);
        // $defaultEndDate = $startDate->copy()->addDay(1)->toDateString();

        $startDate = Carbon::createFromDate($planPriceDate->reservationSlot->reservation_slot_date)->toDateString();
        $defaultEndDate = Carbon::parse($startDate)->addDay(1)->toDateString();

        // dd($defaultEndDate);
        return view('reservations.create', [
            'planPriceDate' => $planPriceDate,
            'defaultEndDate' => $defaultEndDate,
        ]);
    }

    /**
     * 宿泊者情報の一時保存と確認画面への遷移
     *
     * @return \Illuminate\Http\Response
     */
    public function createConfirm(ConfirmRequest $request, $planPriceDate)
    {
        // 送信された内容をセッションに保存
        $request->session()->put('guestDate', $request->all());

        return to_route('reservations.show_confirm', [
            'planPriceDate' => $planPriceDate,
        ]);
    }

    /**
     * 確認画面表示
     *
     */
    public function showConfirm($planPriceDate)
    {
        // セッションからデータを取得
        $guestDate = session()->get('guestDate');
        // dd($guestDate);
        return view('reservations.confirm', [
            'guestDate' => $guestDate,
            'planPriceDate' => $planPriceDate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
