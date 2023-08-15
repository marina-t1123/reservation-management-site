<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\GuestPlanController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ReservationSlotController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//=========================================================
// Admin
//=========================================================
// 管理画面トップ(ログイン後遷移画面)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // お問い合わせ
    Route::get('/inquiry', [InquiryController::class, 'index'])->name('admin.inquiry.index');
    Route::get('/inquiry/{inquiry}', [InquiryController::class, 'show'])->name('admin.inquiry.show');
    Route::get('/inquiry/{inquiry}/change_status', [InquiryController::class, 'changeStatus'])->name('admin.inquiry.change_status');

    // 宿泊プラン
    Route::get('/plans/admin/index', [PlanController::class, 'index'])->name('admin.plans.index');
    Route::get('/plans/create', [PlanController::class, 'create'])->name('admin.plans.create');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('admin.plans.store');
    // 宿泊プラン(料金)
    Route::get('/plans/price/create/{plan}', [PlanController::class, 'createPrice'])->name('admin.plans.create_price');
    Route::post('/plans/price/store/{plan}', [PlanController::class, 'storePrice'])->name('admin.plans.store_price');
    Route::get('/plans/price/{plan}/show', [PlanController::class, 'showPrice'])->name('admin.plans.show_price');
    Route::get('/plans/price/edit/{planPrice}', [PlanController::class, 'editPrice'])->name('admin.plans.edit_price');
    Route::put('/plans/price/edit/{planPrice}', [PlanController::class, 'updatePrice'])->name('admin.plans.update_price');
    Route::delete('/plans/price/delete/{planPrice}', [PlanController::class, 'deletePrice'])->name('admin.plans.delete_price');

    // 予約枠
    Route::get('/reservation_slots', [ReservationSlotController::class, 'index'])->name('admin.reservation_slots.index');
    Route::get('/reservation_slots/create', [ReservationSlotController::class, 'create'])->name('admin.reservation_slots.create');
    Route::post('/reservation_slots/store', [ReservationSlotController::class, 'store'])->name('admin.reservation_slots.store');
    Route::delete('/reservation_slots/{reservationSlot}', [ReservationSlotController::class, 'destroy'])->name('admin.reservation_slots.destroy');

    // 予約
});

//=========================================================
// Guest
//=========================================================
// 公開ページ
Route::get('/top', [PublicPageController::class, 'topPage'])->name('top');
Route::get('/access', [PublicPageController::class, 'accessPage'])->name('access');
Route::get('/rooms', [PublicPageController::class, 'roomsPage'])->name('rooms');
// お問い合わせ
Route::get('/inquiry/create', [InquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry/store', [InquiryController::class, 'store'])->name('inquiry.store');
// 宿泊プラン
Route::get('/plans', [GuestPlanController::class, 'guestIndex'])->name('guest.plans.index');
Route::get('/plans/{plan}', [GuestPlanController::class, 'guestShow'])->name('guest.plans.show');
Route::get('/plans/{plan}/calender', [GuestPlanController::class, 'guestShowCalender'])->name('guest.plans.show_calender');

// 予約
// 予約新規作成画面
Route::get('/reservation/{planPriceDate}', [ReservationController::class, 'create'])->name('reservation.create');
// 予約フォーム情報一時保存と確認画面遷移
Route::post('/reservation/{planPriceDate}/confirm', [ReservationController::class, 'createConfirm'])->name('reservation.create_confirm');
// 予約フォーム情報確認画面
Route::get('/reservation/{planPriceDate}/confirm/show', [ReservationController::class, 'showConfirm'])->name('reservation.show_confirm');
Route::post('/reservation/{planPriceDate}/store', [ReservationController::class, 'store'])->name('reservation.store');
Route::resource('/reservation', ReservationController::class)->except(['create', 'store']);


Route::middleware('auth')->group(function () {
    // プロフィール関連(デフォルト)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
