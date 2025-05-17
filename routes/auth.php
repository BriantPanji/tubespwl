<?php


// Menampilkan pesan "verifikasi email Anda"

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);

    
    Route::get('/forget-password', [PasswordController::class, 'index'])->name('password.forget');
    Route::post('/forget-password', [PasswordController::class, 'request'])->name('password.request');
    Route::get('/reset-password/{token}', [PasswordController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'renew'])->name('password.renew');


});



Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/'); 
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');


    Route::post('/email/verification-notification', function (Request $request) {
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['login' => 'Anda harus login untuk mengirim ulang verifikasi.']);
        }
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Link verifikasi baru telah dikirim!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});






