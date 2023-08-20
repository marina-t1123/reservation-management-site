<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Mail\ReservationCancelMail;
use App\Models\Room;
use App\Models\Plan;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ReservationController\ChangeMemoRequest;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    // 一覧画面
    public function index(Request $request) : View
    {
        // もし、検索フォームからリクエスト送信された値があれば、検索フォームの入力値を元に予約を取得する
        if( !empty($request->all())){
            // 検索フォームからリクエスト送信された値を取得する
            $requestData = $request->all();

            // 予約を検索するためのクエリビルダを作成する
            $query = Reservation::query();
            // 検索フォームの入力値を元に予約を取得する
            if(!empty($requestData['plan_id']) && !empty($requestData['room_id'])){
                $reservations = $query->whereRelation('planPrice', 'plan_id', $requestData['plan_id'])
                                        ->whereRelation('planPrice.reservationSlot.room', 'type', $requestData['room_id'])->get();
            } elseif(!empty($requestData['plan_id'])){
                $reservations = $query->whereRelation('planPrice', 'plan_id', $requestData['plan_id'])->get();
            } elseif(!empty($requestData['room_id'])){
                $reservations = $query->whereRelation('planPrice.reservationSlot.room', 'type', $requestData['room_id'])->get();
            }

            return view('admin.reservations.index',[
                'reservations' => $reservations,
                'plans' => Plan::all(),
                'rooms' => Room::ROOM_TYPE,
            ]);
        }

         // 検索フォームから検索されなかった場合、全ての予約を取得する
         $reservations = Reservation::with('planPrice')->get();

        return view('admin.reservations.index',[
            'reservations' => $reservations,
            'plans' => Plan::all(),
            'rooms' => Room::all(),
        ]);
    }

    // 予約詳細ページ
    public function show(Reservation $reservation) : View
    {
        // 詳細表示をする予約の期間を取得後に、チェックアウト日を取得
        // １泊の場合

        // ２泊以上の場合


        // 予約情報を詳細画面で表示する
         // チェックイン日・チェックアウト・宿泊プラン名・宿泊プラン料金・宿泊者情報・宿泊人数
        return view('admin.reservations.show', compact('reservation'));
    }

    // メモ機能実装
    public function changeMemo(ChangeMemoRequest $request, Reservation $reservation) : View
    {
        // メモを更新する
        $reservation->memo = $request->input('memo');
        $reservation->save();

        return view('admin.reservations.show', compact('reservation'))->with('flash_message', '予約のメモを更新しました');
    }

    // 予約のステータスを更新する
    public function changeStatus(Reservation $reservation)
    {
        // 予約ステータスが予約中の場合、キャンセル済みに更新する
        if($reservation->cancel_at === Reservation::CANCEL_STATUS_FALSE)
        {
            $reservation->cancel_at = Reservation::CANCEL_STATUS_TRUE;
            $reservation->save();

            // キャンセルメールを送信する
            \Mail::to('tm.274795@gmail.com')->send(new ReservationCancelMail($reservation));
            return back()->with('flash_message', '予約をキャンセルしました');
        }

        // 予約ステータスがキャンセル済みの場合、予約中に更新する
        if($reservation->cancel_at === Reservation::CANCEL_STATUS_TRUE)
        {
            $reservation->cancel_at = Reservation::CANCEL_STATUS_FALSE;
            $reservation->save();
            return back()->with('flash_message', '予約を予約状態に変更しました');
        }
    }

}
