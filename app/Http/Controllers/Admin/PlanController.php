<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanPrice;
use App\Models\ReservationSlot;
use Illuminate\View\View;
use App\Http\Requests\PlanController\StoreRequest;
use App\Http\Requests\PlanController\PriceStoreRequest;
use App\Http\Requests\PlanController\PriceUpdateRequest;
use Illuminate\Http\RedirectResponse;

class PlanController extends Controller
{
    // 一覧画面
    public function index() : View
    {
        return view('admin.plans.index',[
            'plans' => Plan::all(),
        ]);
    }

    // 登録画面
    public function create() : View
    {
        return view('admin.plans.create', [
            'reservationSlots' => ReservationSlot::all(),
        ]);
    }

    // プラン登録処理
    public function store(StoreRequest $request) : RedirectResponse
    {
        // dd('store');
        // ToDo 同じ予約枠に紐づいているプランがすでに登録されているかどうかを確認する
        // これをしないと予約枠に紐づいているプランが重複して登録されてしまう
        // これは後でやる。一旦は登録できるようにする

        // $reservationSlot = ReservationSlot::find($request->reservation_slot_id);
        // // 送信されてきた予約枠に紐づいている部屋番号と予約枠日時の組み合わせでプランがすでに登録されているかどうか
        // $isExist = Plan::where('room_id', $reservationSlot->room->id)
        //     ->where('reservation_slot_id', $reservationSlot->id)
        //     ->exists();
        // if( $isExist ){ // trueの場合(一致するプランがあった場合)
        //     return redirect()->route('admin.plans.index')->with('flash_message', 'プランはすでに登録されています。');
        // }else{ // falseの場合(一致するプランがなかった場合)

            // Planテーブル登録
            $plan =  Plan::create([
                'title' => $request->title,
                'explanation' => $request->explanation,
            ]);
            // 中間テーブル登録
            // PlanPrice::create([
            //     'plan_id' => $plan->id,
            //     'reservation_slot_id' => $request->reservation_slot_id,
            //     'price' => $request->price,
            // ]);
            // プラン画像登録
            // 送信された画像の登録処理
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('public/img');
                    $plan->planImages()->create(['path' => $path]);
                }
            }

            return redirect()->route('admin.plans.index')->with('flash_message', 'プランを登録しました。');
    }

    // 宿泊プラン削除処理
    public function destroy(ReservationSlot $reservationSlot) : RedirectResponse
    {
        $reservationSlot->delete();
        return to_route('admin.reservation_slots.index')->with('flash_message', '予約枠を削除しました。');
    }

    // 予約枠・料金登録画面
    public function createPrice($plan) : View
    {
        return view('admin.plan-prices.create', [
            'plan' => Plan::find($plan),
            'reservationSlots' => ReservationSlot::all(),
        ]);
    }

    // 予約枠・料金登録処理
    public function storePrice(PriceStoreRequest $request, $plan) : RedirectResponse
    {
        // リクエスト送信された予約枠IDを持つ予約枠を取得
        $reservationSlot = ReservationSlot::find($request->reservation_slot_id);
        if( !$reservationSlot  ){
            // 予約枠・料金登録画面に戻る
            return redirect()->route('admin.plans.create_price', ['plan' => $plan])->with('flash_message', '指定された予約枠が取得できません。');
        }
        // アーリーリターン

        // リクエスト送信された予約枠に紐づいている部屋番号と宿泊プラン設定日の日付と同じ組み合わせの予約枠が登録済みかどうか
        $isExist = PlanPrice::where('reservation_slot_id', $reservationSlot->id)
            ->where('plan_id', intval($plan))
            ->exists();

        if ($isExist) {
            // 予約枠・料金登録画面に戻る
            return redirect()->route('admin.plans.create_price', ['plan' => $plan])->with('flash_message', '指定された予約枠の部屋番号と宿泊プラン設定日の日付の組み合わせの予約枠にはすでに宿泊プランと料金が設定されています。');
        } else {
            // 予約枠・料金登録処理
            PlanPrice::create([
                'plan_id' => $plan,
                'reservation_slot_id' => $request->reservation_slot_id,
                'price' => $request->price,
            ]);
            // 予約枠・料金登録画面に戻る
            return redirect()->route('admin.plans.create_price', ['plan' => $plan])->with('flash_message', '予約枠に宿泊プランと料金を設定しました。');
        }
    }

    // 各宿泊プランに紐づく予約枠・料金一覧画面
    public function showPrice($plan) : View
    {
        return view('admin.plan-prices.show', [
            'plan' => Plan::find($plan),
        ]);
    }

    // 各宿泊プランに紐づく予約枠・料金編集画面
    public function editPrice($planPrice) : View
    {
        $planPrice = PlanPrice::find($planPrice);
        return view('admin.plan-prices.edit', [
            'plan' => $planPrice->plan,
            'planPrice' => $planPrice,
        ]);
    }

    // 料金編集処理
    public function updatePrice(PriceUpdateRequest $request, $planPrice) : RedirectResponse
    {
        $planPrice = PlanPrice::find($planPrice);
        // リクエスト送信された予約枠の宿泊プランの料金を更新する
        $planPrice->price = $request->price;
        $planPrice->save();
        // 予約枠・料金登録画面に戻る
        return redirect()->route('admin.plans.show_price', ['plan' => $planPrice->plan])->with('flash_message', '宿泊プランの予約枠を料金を更新しました。');
    }

    // 削除処理
    public function deletePrice($planPrice)
    {
        $planPrice = PlanPrice::find($planPrice);
        $planPrice->delete();
        return back()->with('flash_message', '予約枠・料金を削除しました。');
    }

}
