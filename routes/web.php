<?php

use App\Models\Post;
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

// Edit & Hapus postingan
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->middleware('auth')->name('post.edit');
Route::put('/post/{post}', [PostController::class, 'update'])->middleware('auth')->name('post.update');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('post.delete');

//Laporkan Post
Route::post('/report/{post}', [PostController::class, 'report'])->middleware('auth')->name('post.report');

// Search
Route::get('/search', [PostController::class, 'search']);
Route::post('/search/delete-history', [PostController::class, 'delete_history']);
Route::post('/search/delete-all-history', [PostController::class, 'delete_all_history']);


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

//Profile lain
// Route::get('/profile/{id}', [RegisterUserController::class, 'showOther'])->name('profile.other');
Route::get('/profile/{id}', function($id) {
    $user = User::findOrFail($id);

    $myposts = Post::where('user_id', $id)->with('attachments')->get();
    $postCount = $user->posts()->count();
    $commentCount = $user->comments()->count();
    $badgeCount = $user->badges()->count();
    $postVoteCount = $user->votedPost()->count();
    $bookmarkCount = $user->bookmarks()->count();

    return view('profile.other', compact('user', 'myposts', 'postCount', 'commentCount', 'badgeCount', 'postVoteCount', 'bookmarkCount'));
})->name('profile.other');

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
    $comments = Auth::user()->comments()->with('post')->latest()->get();
    return view('dashboard.comment', compact('comments'));
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
    $myvotes = Auth::user()->votedPost()->with('user')->get();
    return view('dashboard.myvotes', compact('myvotes'));
})->middleware('auth')->name('profile.vote');
