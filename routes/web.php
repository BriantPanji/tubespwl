<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Auth;

//Beranda
Route::get('/', [PostController::class, 'index']);
Route::get('/post/add', [PostController::class, 'create'])->name('post.create')->middleware('auth');
Route::patch('/post/add', [PostController::class, 'store'])->name('post.store')->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.detail');
Route::post('/post/{post}/upvote', [PostController::class, 'upvote'])->middleware('auth')->name('post.upvote');
Route::post('/post/{post}/downvote', [PostController::class, 'downvote'])->middleware('auth')->name('post.downvote');
Route::post('/post/{post}/bookmark', [PostController::class, 'bookmark'])->middleware('auth');
Route::post('/post/{post}', [PostController::class, 'storeComment'])->middleware('auth')->name('post.comment');


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
})->middleware('auth')->name('profile');

// Route untuk tampilkan form edit profile
Route::get('/profile/edit', [RegisterUserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile/edit', [RegisterUserController::class, 'update'])->name('profile.update')->middleware('auth');


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
})->middleware('auth')->name('profile.comment');

Route::get('/my/bookmarks', function () {
    $bookmarks = Auth::user()->bookmarks()->with(['user', 'attachments'])->get();
    return view('dashboard.bookmarks', compact('bookmarks'));
})->middleware('auth')->name('profile.bookmark');



Route::get('/my/post', function () {
    $myposts = Auth::user()->posts()->with('user')->get();

    return view('dashboard.mypost', compact('myposts'));
})->middleware('auth')->name('profile.post');

Route::get('/my/votes', function () {
    $myposts = Auth::user()->posts()->with('user')->get();
    return view('dashboard.mypost', compact('myposts'));
})->middleware('auth')->name('profile.vote');