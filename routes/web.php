<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PostController;


//TES BERANDA
Route::get('/', function () {
    return view('tes');
});


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/tes', function () {
    return view('welcome');
});

Route::get('/my/comments', function () {
    // $comments = User::with('comments')->get();
    $posts = Auth::user()->comments()->with('post.user')->get()->pluck('post');
    
    return view('dashboard.comment', compact('posts'));
})->middleware('auth');
