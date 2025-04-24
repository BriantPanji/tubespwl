<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts_view()
    {
        $posts = Post::with('user')->get();
        $badges = User::with('badges')->get();

        return view('home', [
            'posts' => $posts,
            'badges' => $badges,
        ]);
    }

    public function post_detail($postId)
    {
        $post = Post::with('user')->findOrFail($postId);
        $badges = User::with('badges');
        $comments = User::with('comments')->findOrFail($postId);

        return view('post_detail', [
            'post' => $post,
            'badges' => $badges,
            'comments' => $comments,
        ]);
    }
}
