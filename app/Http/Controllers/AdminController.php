<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $reportedPosts = Post::whereHas('reports') // Hanya ambil postingan yang punya laporan
            ->with(['reports', 'user']) // Memuat relasi 'reports' (pelapor) dan 'user' (pemilik post)
            ->get();

        return view('post.reported', compact('reportedPosts'));
    }
}
