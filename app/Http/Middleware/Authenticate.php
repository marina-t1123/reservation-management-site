<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // ユーザー(今回はAdminしかいない為、Adminユーザー)が認証されていない場合に、リダイレクトするURLを定義

    // Authenticateクラスのプロパティとして、Adminのログイン画面のURLを定義
    // これにより、Adminのログイン画面にリダイレクトされる
    protected $admin_login_route = 'admin/login';
    // ここで指定しているroute情報は、RouteServiceProvider.phpのbootメソッドで指定したものと同じである必要がある

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        if (! $request->expectsJson()) {
        // リクエストがJSONじゃなかった場合、URLの分岐に入る
        // 今回はAdminのログイン画面に遷移させる。
            return route($this->admin_login_route);
        }

    }
}
