<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        $reportedPostsCount = Post::whereHas('reports')->count(); 
        $reportedCommentsCount = Comment::whereHas('reports')->count();
        $votedPostsCount = Post::whereHas('votedBy')->count(); 
        $votedCommentsCount = Comment::whereHas('votes')->count();
        $tagsCount = Post::with('tag')->get()->pluck('tag')->flatten()->unique('id')->count(); 

        $admins = User::where('is_admin', true)->get();

        $reportedPosts = Post::withCount('reports')
            ->whereHas('reports')
            ->with('user')
            ->withCount('reports')
            ->orderByDesc('reports_count')
            ->take(3)
            ->get();

        $reportedComments = Comment::withCount('reports')
            ->whereHas('reports')
            ->with(['user', 'post'])
            ->withCount('reports')
            ->orderByDesc('reports_count')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'userCount',
            'postCount', 
            'commentCount', 
            'reportedPostsCount', 
            'reportedCommentsCount',
            'votedPostsCount', 
            'votedCommentsCount', 
            'tagsCount', 
            'admins',
            'reportedPosts',
            'reportedComments'
        ));
    }

    public function makeAdmin(Request $request, User $user)
    {
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('success', 'User has been promoted to admin.');
    }
    public function revokeAdmin(Request $request, User $user)
    {
        $user->is_admin = false;
        $user->save();

        return redirect()->back()->with('success', 'Admin privileges have been revoked.');
    }

    public function showPost()
    {
        $reportedPosts = Post::whereHas('reports') // Hanya ambil postingan yang punya laporan
            ->with(['reports', 'user']) // Memuat relasi 'reports' (pelapor) dan 'user' (pemilik post)
            ->get();

        return view('admin.reported', compact('reportedPosts'));
    }

    public function showCom(){
        $reportedComs = Comment::whereHas('reports')
        ->with(['reports', 'user'])
        ->get();

        return view('admin.comment', compact('reportedComs'));
    }

    public function showUsers()
    {
        $users = User::get();
        return view('admin.user', compact('users'));
    }
    

    public function deleteUser(Request $request, User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted.');
    }

    public function banUser(Request $request, User $user)
    {
        $user->is_banned = true;
        $user->save();

        return redirect()->back()->with('success', 'User has been banned.');
    }
    public function unbanUser(Request $request, User $user)
    {
        $user->is_banned = false;
        $user->save();

        return redirect()->back()->with('success', 'User has been unbanned.');
    }

    public function showTags()
    {
        $tags = Tag::withCount('taggedPost')->get();

        return view('admin.tags', compact('tags'));
    }
    public function deleteTag(Request $request, Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with('success', 'Tag has been deleted.');
    }

}
