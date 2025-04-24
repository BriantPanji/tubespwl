<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;

//Beranda
Route::get('/', [PostController::class, 'posts_view']);

Route::get('/post/{post}', [PostController::class, 'post_detail'])->middleware('auth');

//TES PROFILE
Route::get('/profile', function () {
    $user = Auth::user();

    // Hitung jumlah postingan, komentar,badge, bookmark dan postvotes
    $postCount = $user->posts()->count();
    $commentCount = $user->comments()->count();
    $badgeCount = $user->badges()->count();
    $postVoteCount = $user->votedPost()->count();
    $bookmarkCount = $user->bookmarks()->count();

    return view('profile', [
        'user' => $user,
        'postCount' => $postCount,
        'commentCount' => $commentCount,
        'badgeCount' => $badgeCount,
        'postVoteCount' => $postVoteCount, 
        'bookmarkCount' => $bookmarkCount, 
    ]);
})->middleware('auth');

    
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Post

Route::get('/tes', function () {
    return view('welcome');
});

Route::get('/my/comments', function () {
    // $comments = User::with('comments')->get();
    $posts = Auth::user()->comments()->with('post.user')->get()->pluck('post');

    return view('dashboard.comment', compact('posts'));
})->middleware('auth');

Route::get('/my/bookmarks', function () {
    $bookmarks = auth()->user()->bookmarks()->with('post.user')->get();
    return view('dashboard.bookmarks', compact('bookmarks'));
})->middleware('auth')->name('bookmarks');
    
Route::get('/my/post', function () {
    $myposts = auth()->user()->posts()->with('user')->get();
    return view('dashboard.mypost', compact('myposts'));
})->middleware('auth')->name('mypost');