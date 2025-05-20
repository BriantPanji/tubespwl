<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Tandai semua sebagai sudah dibaca
        $user->unreadNotifications->markAsRead();
        return view('notification', [
            'notifications' => $user->notifications,
        ]);
    }
}
