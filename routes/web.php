<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

Route::middleware(['email_verified', 'not_banned'])->group(function () {

    //Admin Dashboard
    Route::middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/reportedPosts', [AdminController::class, 'showPost'])->name('admin.post');
        Route::get('/admin/reportedComments', [AdminController::class, 'showCom'])->name('admin.comment');

        Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.user');
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
        Route::patch('/admin/users/ban/{user}', [AdminController::class, 'banUser'])->name('admin.ban-user');
        Route::patch('/admin/users/unban/{user}', [AdminController::class, 'unbanUser'])->name('admin.unban-user');

        Route::get('/admin/tags', [AdminController::class, 'showTags'])->name('admin.tags');
        Route::delete('/admin/tags/{tag}', [AdminController::class, 'deleteTag'])->name('admin.delete-tag');

        Route::post('/admin/make-admin/{user}', [AdminController::class, 'makeAdmin'])->name('admin.make-admin');
        Route::post('/admin/revoke-admin/{user}', [AdminController::class, 'revokeAdmin'])->name('admin.revoke-admin');

        Route::get('/admin/edit-badge/{user}', [AdminController::class, 'controlBadge'])->name('admin.badge');
        Route::patch('/admin/edit-badge/add/{user}', [AdminController::class, 'addBadge'])->name('admin.badge-add');
        Route::delete('/admin/edit-badge/remove/{user}', [AdminController::class, 'removeBadge'])->name('admin.badge-remove');
    });

// Notifikasi
    Route::get('/notification', [NotificationController::class, 'index']);

    // Post
    Route::get('/', [PostController::class, 'index']);
    Route::get('/post/add', [PostController::class, 'create'])->name('post.create')->middleware('auth');
    Route::patch('/post/add', [PostController::class, 'store'])->name('post.store')->middleware('auth');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('post.detail');
    Route::post('/comment/{post}', [CommentController::class, 'store'])->middleware('auth')->name('post.comment');

    // Upvote/Downvote Post
    Route::post('/post/{post}/upvote', [PostController::class, 'upvote'])->middleware('auth')->name('post.upvote');
    Route::post('/post/{post}/downvote', [PostController::class, 'downvote'])->middleware('auth')->name('post.downvote');

    Route::post('/post/{post}/report', [PostController::class, 'report'])->middleware('auth')->name('post.report');

    // Bookmark
    Route::post('/post/{post}/bookmark', [PostController::class, 'bookmark'])->middleware('auth');

    // Comment
    Route::post('/comment/{comment}/upvote', [CommentController::class, 'upvote'])->middleware('auth')->name('comment.upvote');
    Route::post('/comment/{comment}/downvote', [CommentController::class, 'downvote'])->middleware('auth')->name('comment.downvote');

    Route::post('/comment/{comment}/report', [CommentController::class, 'report'])->middleware('auth')->name('comment.report');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comment.delete');

    // Edit & Hapus postingan
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->middleware('auth')->name('post.edit');
    Route::put('/post/{post}', [PostController::class, 'update'])->middleware('auth')->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('post.delete');

    // Search
    Route::get('/search', [PostController::class, 'search']);
    Route::post('/search/delete-history', [PostController::class, 'delete_history']);
    Route::post('/search/delete-all-history', [PostController::class, 'delete_all_history']);

    Route::get('/tagar/{tag}', [PostController::class, 'showTag'])->name('tag.show');


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

    //Profile lain
    // Route::get('/profile/{id}', [RegisterUserController::class, 'showOther'])->name('profile.other');
    Route::get('/profile/{user:username}', function (User $user) {

        $myposts = Post::where('user_id', $user->id)->with('attachments')->get();
        $postCount = $user->posts()->count();
        $commentCount = $user->comments()->count();
        $badgeCount = $user->badges()->count();
        $postVoteCount = $user->votedPost()->count();
        $bookmarkCount = $user->bookmarks()->count();

        return view('profile.other', compact('user', 'myposts', 'postCount', 'commentCount', 'badgeCount', 'postVoteCount', 'bookmarkCount'));
    })->name('profile.other');


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
});


require __DIR__.'/auth.php';

//penjelasan badges
Route::get('/badges',
 [\App\Http\Controllers\BadgeController::class,
  'index'])->name('badges.index');
