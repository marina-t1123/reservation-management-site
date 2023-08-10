<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationSlot;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ReservationSlotController\StoreRequest;
use Illuminate\Http\RedirectResponse;

class ReservationSlotController extends Controller
{
    // 一覧画面
    public function index() : View
    {

        return view('admin.reservation-slots.index',[
            'reservationSlots' => ReservationSlot::all(),
        ]);
    }

    // 登録画面
    public function create() : View
    {
        return view('admin.reservation-slots.create', [
            'rooms' => Room::all(),
        ]);
    }

    // 予約枠登録処理
    public function store(StoreRequest $request) : RedirectResponse
    {
        // dd($request->all());
        // すでに登録済の予約枠で部屋IDと日付が一致するものがあるかどうか
        if( $request->date ){ //個別日時が登録された場合
            // dd('個別日時');
            $isExist = ReservationSlot::where('room_id', $request->room_id)
                ->where('reservation_slot_date', $request->date)
                ->exists();
            if( $isExist ){ // trueの場合(一致する予約枠があった場合)
                return redirect()->route('admin.reservation_slots.index')->with('flash_message', '予約枠はすでに登録されています。');
            }else{ // falseの場合(一致する予約枠がなかった場合)
                ReservationSlot::create([
                    'room_id' => $request->room_id,
                    'reservation_slot_date' => $request->date,
                ]);
                return redirect()->route('admin.reservation_slots.index')->with('flash_message', '予約枠を登録しました。');
            }
        } else { //期間が登録された場合
            // すでに登録済の予約枠で部屋IDと日付が一致するものがあるかどうか
            $isExist = ReservationSlot::where('room_id', $request->room_id)
                ->where('reservation_slot_date', '>=', $request->start_date)
                ->where('reservation_slot_date', '<=', $request->end_date)
                ->exists();
            if( $isExist ){ // trueの場合(一致する予約枠があった場合)
                return redirect()->route('admin.reservation_slots.index')->with('flash_message', '予約枠はすでに登録されています。');
            }else{ // falseの場合(一致する予約枠がなかった場合)
                $date = $request->start_date;
                while( $date <= $request->end_date ){
                    ReservationSlot::create([
                        'room_id' => $request->room_id,
                        'reservation_slot_date' => $date,
                    ]);
                    $date = date('Y-m-d', strtotime($date . '+1 day'));
                }
                return redirect()->route('admin.reservation_slots.index')->with('flash_message', '予約枠を登録しました。');
            }
        }
    }

    // 削除処理
    public function destroy(ReservationSlot $reservationSlot) : RedirectResponse
    {
        $reservationSlot->delete();
        return to_route('admin.reservation_slots.index')->with('flash_message', '予約枠を削除しました。');
    }

}
