<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Plan;
use App\Models\PlanPrice;
use App\Models\Room;
use App\Http\Requests\PlanController\SearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GuestPlanController extends Controller
{

    // 一覧画面
    public function guestIndex(SearchRequest $request) : View
    {
        // プラン名で曖昧検索
        $searchPlanName = $request->input('plan_name');
        // プランを検索するためのクエリビルダを作成
        $query = Plan::query();
        // もしプラン名が入力されていたら
        if(!empty($searchPlanName)) {
            $plans = $query->where('title', 'like', '%'.$searchPlanName.'%')->get();
        } else {
            $plans = Plan::all();
        }

        return view('plans.index',[
            'plans' => $plans,
        ]);
    }

    // 詳細画面
    public function guestShow(plan $plan) : View
    {
        return view('plans.show', [
            'plan' => $plan,
        ]);
    }

    // 空室カレンダー表示
    public function guestShowCalender(Request $request, plan $plan) : View
    {

        // 空室カレンダーのページで部屋タイプが選択されていたら、その部屋タイプに紐づく予約枠を取得する
        $roomType = $request->input('room_type_id'); // シングル、ダブル、ツインのどれかが入っている
        // dd($roomType);
        if(!empty($roomType)) {
            $planPrices = PlanPrice::where('plan_id', $plan->id)
                        ->whereHas('reservationSlot.room', function($query) use($roomType) {
                            $query->where('type', '=', $roomType);
                        })->get();
        } else { // 部屋タイプが選択されていなかったら、シングルルームの予約枠を取得する
            $planPrices = PlanPrice::where('plan_id', $plan->id)
                        ->whereHas('reservationSlot.room', function($query) {
                            $query->where('type', '=', 'シングル');
                        })->get();
        }

        // TO DO
        // planPriceをreservationSlotのdateカラム（日毎）でグループ化する
        $groupedPlanPrices = $planPrices->groupBy(function (PlanPrice $planPrice) {
            return $planPrice->reservationSlot->reservation_slot_date;
        });

        // 上記で取得した、部屋タイプに紐づく予約枠の配列を繰り返し処理を使って、カレンダーの表示項目の配列に格納する
        // カレンダーの表示項目：空室状況、予約ページリンク
        // 上記で日毎にグループ化したplanPriceを繰り返し処理を使って、カウント数を取得する→カウント数によって、空室状況（○×△）を表示する
        // dd($groupedPlanPrices);
        foreach($groupedPlanPrices as $groupedPlanPrice => $planPrice){

            // dd($groupedPlanPrice);
            // カウント数を取得する
            $roomsCount = $planPrice->count();
            // dd($roomsCount);

            // カウント数によって、カレンダーに表示する空室状況（○×△）を設定する
            if($roomsCount == 0) {
                $roomsCount = '×';
            } elseif($roomsCount >= 2 ) {
                $roomsCount = '○';
            } elseif($roomsCount == 1) {
                $roomsCount = '△';
            }
            // dd($roomsCount);

            // $calenderData = [ ];
            $calenderData[] = ['title' => $roomsCount, 'start' => $groupedPlanPrice, 'url' => route('guest.plans.show', $plan->id)];
            // dd($calenderData);
        }

        // 多次元配列の一番最後に要素を追加する
        // array_push($calenderData, ['title' => $roomsCount, 'start' => $groupedPlanPrice]);

        return view('plans.calendar', [
            'plan' => $plan,
            'planPrices' => $planPrices,
            'calenderData' => $calenderData,
            'rooms' => Room::ROOM_TYPE,
        ]);
    }




    // 空室カレンダーに表示する予約枠を取得
    // public function guestReservationSlot(, plan $plan) : array
    // {
    //     //dd($request->all()); // ここで、room_type_id取得できている。"room_type_id" => "シングル"
    //     // プランに紐づくPlanPriceを取得する
    //     $reservationSlots = $plan->planPrices()->get()->toArray();
    //     dd($reservationSlots);

    //     // カレンダーのページで部屋タイプが選択されていたら、その部屋タイプに紐づく予約枠を取得する
    //     // $roomTypeId = $request->input('room_type_id');
    //     // if(!empty($roomTypeId)) {
    //     //     $reservationSlots = $plan->planPrices()->where('room_type_id', $roomTypeId)->get()->toArray();
    //     //     return $reservationSlots;
    //     // } else { // 部屋タイプが選択されていなかったら、シングルルームの予約枠を取得する
    //     //     $reservationSlots = $plan->planPrices()->where('room_type_id', 1)->get()->toArray();
    //     //     // ここで、日付ごとの宿泊可能な予約枠の数を取得する(countで取得する)
    //     //     $planReservationSlots = [];
    //     //     // foreach($plan->planPrices as $planPrice)
    //     //     //     $planReservationSlots[] = [
    //     //     //         'title' => $planPrice->roomType->name,
    //     //     //         // titleに⚪︎×△を表示する。ここで上記で取得したカウント数に対してif文を使って、予約枠の状態によって表示するマークを変える条件分岐を実装する
    //     //     //         'description' => $planPrice->roomType->name,
    //     //     //         'start' => $planPrice->reservationSlot->start_time,
    //     //     //         'end'   => $planPrice->reservationSlot->end_time,
    //     //     //     ];
    //     //     // endforeach
    //     //     return $reservationSlots;
    //     // }


    //     // デフォルトでカレンダーに表示するプランに紐づく予約枠を取得して返す
    //     // return [
    //     //     [
    //     //         'title' => '美容院', // titleに⚪︎×△を表示する。ここでif文を使って、予約枠の状態によって表示するマークを変える
    //     //         'description' => '人気の美容室予約取れた',
    //     //         'start' => '2023-08-10',
    //     //         'end'   => '2023-08-10',
    //     //     ],
    //     //     [
    //     //         'title' => 'シルバーウィーク旅行',
    //     //         'description' => '人気の旅館の予約が取れた',
    //     //         'start' => '2023-08-20 10:00:00',
    //     //         'end'   => '2023-08-22 18:00:00',
    //     //         'url'   => 'https://admin.juno-blog.site',
    //     //     ],
    //     //     [
    //     //         'title' => '給料日',
    //     //         'start' => '2023-08-30',
    //     //         'color' => '#ff44cc',
    //     //     ],
    //     // ];
    // }

}
