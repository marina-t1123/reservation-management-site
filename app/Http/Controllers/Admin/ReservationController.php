<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    // 予約一覧画面を表示する
    public function index() : View
    {
        return view('admin.reservations.index');
    }

    // 予約詳細画面を表示する

    // 予約編集画面を表示する

    // 予約を更新する

    // 予約をキャンセルする


}
