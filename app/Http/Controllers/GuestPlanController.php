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
        foreach($groupedPlanPrices as $groupedPlanPrice => $planPrice){
            // カウント数を取得する
            $roomsCount = $planPrice->count();

            // dd($planPrice);

            // カウント数によって、カレンダーに表示する空室状況（○×△）を設定する
            if($roomsCount == 0) {
                $roomsCount = '×';
            } elseif($roomsCount == 1) {
                $roomsCount = '△';
            } elseif($roomsCount >= 2 ) {
                $roomsCount = '○';
            }
            // dd($planPrice);

            // ここでカレンダー内のulrで使用するPlanPrice(紐づいているReservationSlot)を取得する
            // $planPriceには、PlanPriceモデルのインスタンスが複数(Collection)入っている場合があるので、最初の要素を取得する
            $planPriceDate = $planPrice->first();

            // カレンダーの表示項目の配列にそれぞれ必要な情報を格納する
            $calenderData[] = ['title' => $roomsCount, 'start' => $groupedPlanPrice, 'url' => route('reservation.create', $planPriceDate)];
        }
        // dd($planPriceDate);

        // 多次元配列の一番最後に要素を追加する
        // array_push($calenderData, ['title' => $roomsCount, 'start' => $groupedPlanPrice]);

        return view('plans.calendar', [
            'plan' => $plan,
            'planPrices' => $planPrices,
            'calenderData' => $calenderData,
            'rooms' => Room::ROOM_TYPE,
        ]);
    }


}
