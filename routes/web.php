<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;

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
Route::middleware('auth')->group(function () {
    // お問い合わせ関連
    Route::get('/admin/inquiry', [AdminInquiryController::class, 'index'])->name('admin.inquiry.index');
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
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
// 宿泊プラン

// 予約


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール関連(デフォルト)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // お問い合わせ関連
    Route::get('/inquiry/index', [InquiryController::class, 'index'])->name('inquiry.index');

});

require __DIR__.'/auth.php';
