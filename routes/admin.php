<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AutoLoginController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\ReservationController;
use Illuminate\Support\Facades\Route;


// 公開ページ
Route::get('/top', [PublicPageController::class, 'topPage'])->name('top');
Route::get('/access', [PublicPageController::class, 'accessPage'])->name('access');
Route::get('/rooms', [PublicPageController::class, 'roomsPage'])->name('rooms');


Route::middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});



// 予約枠関連
Route::prefix('reservations')->middleware('auth:admin')->group(function () {
    Route::get('index', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::post('store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::post('update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::post('destroy/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
});

// 予約関連

// 宿泊プラン関連

// お問い合わせ関連


