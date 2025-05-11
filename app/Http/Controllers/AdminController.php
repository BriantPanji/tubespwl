<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}
