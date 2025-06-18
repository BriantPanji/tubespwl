<?php


// Menampilkan pesan "verifikasi email Anda"

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
        if (Auth::user()->hasVerifiedEmail()) {
            return redirect('/')->with('message', 'Email Anda sudah terverifikasi.');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        Log::info('Attempting to verify email. Incoming URL: ' . $request->fullUrl());
        Log::info('Request headers: ' . json_encode($request->headers->all())); // Log all headers
        Log::info('Request server variables: ' . json_encode($request->server->all())); // Log server variables

        // Log the components Laravel uses to reconstruct and verify the signature
        $expectedUrlForVerification = URL::temporarySignedRoute(
            'verification.verify',
            // We don't have the original expiration time here directly
            // So, we'll log the current request's parameters which were part of the original URL
            // This won't perfectly re-generate the *original* signature if expires is slightly different
            // but it shows what Laravel is currently working with for verification.
            now()->addMinutes(config('auth.verification.expire', 60)), // Use configured expiry
            ['id' => $request->route('id'), 'hash' => $request->route('hash')]
        );
        Log::info('Internally reconstructed URL for verification (approximate, for comparison): ' . $expectedUrlForVerification);
        Log::info('Route parameters: id=' . $request->route('id') . ', hash=' . $request->route('hash'));
        Log::info('Query parameters: ' . json_encode($request->query()));


        try {
            // The original logic: $request->fulfill() might throw if signature is already deemed invalid
            // by middleware before this point. The 'signed' middleware usually runs before the controller action.
            // For now, let's assume we can reach this point or that fulfill() re-checks.
            
            // If the 'signed' middleware already threw an exception, this part might not be reached.
            // The critical logs are the ones above.

            $request->fulfill();
            Log::info('Email verification fulfilled for user ID: ' . $request->route('id'));
            return redirect('/')->with('message', 'Email verified successfully!');

        } catch (\Illuminate\Routing\Exceptions\InvalidSignatureException $e) {
            Log::error('InvalidSignatureException caught in route: ' . $e->getMessage());
            // Potentially re-throw or handle as per application's desired flow for bad signatures
            // For now, just log and let the default exception handler take over or return a custom response.
            return response('Invalid signature from route log.', 403); // Or rethrow $e
        } catch (\Exception $e) {
            Log::error('Generic exception during email verification: ' . $e->getMessage());
            return response('Error during verification.', 500); // Or rethrow $e
        }
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






