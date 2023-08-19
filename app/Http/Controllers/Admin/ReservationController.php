<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ReservationController\ChangeMemoRequest;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    // 一覧画面
    public function index() : View
    {
        return view('admin.reservation.index',[
            'reservations' => Reservation::all(),
        ]);
    }

    // 予約詳細ページ
    public function show($reservation) : View
    {
        return view('admin.reservation.show', compact('reservation'));
    }

    // メモ機能実装
    public function changeMemo(ChangeMemoRequest $request, Reservation $reservation) : RedirectResponse
    {
        // メモを更新する
        $reservation->memo = $request->input('memo');
        $reservation->save();

        return to_route('admin.reservation_slots.show', compact('reservation'))->with('flash_message', '予約のメモを更新しました');
    }

    // 予約のステータスを更新する
    public function changeStatus(Reservation $reservation)
    {
        
    }

}
