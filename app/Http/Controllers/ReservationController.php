<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\PlanPrice;
use App\Http\Requests\ReservationController\ConfirmRequest;
use App\Http\Requests\ReservationController\StoreRequest;
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
        // チェックアウト日のデフォルト値を設定(チェックイン日の翌日)
        $startDate = Carbon::createFromDate($planPriceDate->reservationSlot->reservation_slot_date)->toDateString();
        $defaultEndDate = Carbon::parse($startDate)->addDay(1)->toDateString();

        // dd($planPriceDate); PlanPriceモデルのインスタンスが入っている
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
    public function createConfirm(ConfirmRequest $request, PlanPrice $planPriceDate)
    {
        // 送信された内容をセッションに保存
        $request->session()->put('guestDate', $request->all());

        // dd($planPriceDate);

        return to_route('reservation.show_confirm', [
            'planPriceDate' => $planPriceDate,
        ]);
    }

    /**
     * 確認画面表示
     *
     */
    public function showConfirm(PlanPrice $planPriceDate)
    {
        // セッションからデータを取得
        $guestDate = session()->get('guestDate');
        // ddd($planPriceDate);
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
    public function store(StoreRequest $request,)
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
