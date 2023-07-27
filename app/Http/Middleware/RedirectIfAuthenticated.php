<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    // ユーザーがAdminとしてログインしている状態で、Adminのログイン画面を表示しようとした場合のリダイレクト処理を設定する。

    // 定数でconfig/auth.phpのguardsでの設定の項目を指定する
    private const GUARD_ADMIN = 'admins';
    // ここで指定しているguard情報は、config/auth.phpのguardsでの設定の項目と同じである必要がある

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // Adminユーザー(ログイン済み)がAdminのログイン画面にアクセスした場合、Adminのログイン後のリダイレクト先に遷移させる
        if (Auth::guard(self::GUARD_ADMIN)->check() && $request->routeIs('admin.*')) {
        //もし、adminユーザーで認証しているかcheckメソッドでチェックをして認証していた場合
        //かつ、リクエストが名前付きルート(admin.*)だった場合
            return redirect(RouteServiceProvider::ADMIN_HOME);
            //RouteServiceProvider.phpのADMIN_HOMEの定数で指定したURL(予約一覧画面)にリダイレクトさせる
        }

        return $next($request);
    }
}
