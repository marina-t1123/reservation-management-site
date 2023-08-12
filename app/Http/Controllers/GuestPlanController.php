<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Plan;
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

}
