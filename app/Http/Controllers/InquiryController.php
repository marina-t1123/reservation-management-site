<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Requests\InquiryController\StoreRequest;
use App\Mail\InquirySendMail;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class InquiryController extends Controller
{

    // 一覧画面
    public function index() : View
    {

        return view('inquiry.index',[
            'inquiries' => Inquiry::all(),

        ]);
    }

    // 詳細画面
    public function show(Inquiry $inquiry) : View
    {
        return view('inquiry.show', [
            'inquiry' => $inquiry,
        ]);
    }

    // 登録画面
    public function create() : View
    {
        return view('inquiry.create');
    }

    // お問い合わせ内容登録処理
    public function store(StoreRequest $request) : RedirectResponse
    {

        // お問い合わせ内容を登録する処理
        $inquiry = Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
        ]);
        // お問い合わせ作成後にメールを送信する
        \Mail::to($request->email)->send(new InquirySendMail($inquiry));
        \Mail::to('tm.274795@gmail.com')->send(new InquirySendMail($inquiry));

        return redirect()->route('top')->with('flash_message', 'お問い合わせを送信しました。');
    }

    // 対応ステータス変更処理
    public function changeStatus(Inquiry $inquiry) : RedirectResponse
    {
        // 対応ステータスを変更する処理
        $inquiry->update([
            'support_status' => !$inquiry->support_status,
        ]);

        return redirect()->route('admin.inquiry.index')->with('flash_message', '対応ステータスを変更しました。');
    }
}
