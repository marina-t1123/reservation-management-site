<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ReservationSlotController;

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
// Route::middleware('auth')->group(function () {

// });

//=========================================================
// Guest
//=========================================================
// 公開ページ
Route::get('/top', [PublicPageController::class, 'topPage'])->name('top');
Route::get('/access', [PublicPageController::class, 'accessPage'])->name('access');
Route::get('/rooms', [PublicPageController::class, 'roomsPage'])->name('rooms');
// お問い合わせ
Route::get('/inquiry', [InquiryController::class, 'index'])->name('admin.inquiry.index');
Route::get('/inquiry/create', [InquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry/store', [InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/inquiry/{inquiry}', [InquiryController::class, 'show'])->name('admin.inquiry.show');
Route::get('/inquiry/{inquiry}/change_status', [InquiryController::class, 'changeStatus'])->name('admin.inquiry.change_status');
// 宿泊プラン

// 予約

// 予約枠
Route::get('/reservation_slots', [ReservationSlotController::class, 'index'])->name('admin.reservation_slots.index');
Route::get('/reservation_slots/create', [ReservationSlotController::class, 'create'])->name('admin.reservation_slots.create');
Route::post('/reservation_slots/store', [ReservationSlotController::class, 'store'])->name('admin.reservation_slots.store');
Route::delete('/reservation_slots/{reservationSlot}', [ReservationSlotController::class, 'destroy'])->name('admin.reservation_slots.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール関連(デフォルト)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
