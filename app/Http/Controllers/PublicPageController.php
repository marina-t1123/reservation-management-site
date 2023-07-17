<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    /**
     * TOPページを表示する
     *
     * @return View/View
     */
    public function topPage() {
        return view('public_page.top');
    }

    /**
     * 客室ページを表示する
     *
     * @return View/View
     */
    public function roomsPage() {
        return view('public_page.rooms');
    }

    /**
     * アクセスページを表示する
     *
     * @return View/View
     */
    public function accessPage() {
        return view('public_page.access');
    }


    // アクセスページを表示する

}
