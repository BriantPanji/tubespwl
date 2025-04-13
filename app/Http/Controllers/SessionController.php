<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        if (Auth::check()) return redirect('/');
        return view('auth.login');
    }

    public function store() {
        if (Auth::check()) {
            return response()->json([
                'success' => false,
                'code' => 403,
                'message' => "Tidak dapat login dua kali"
            ], 403);
        }

        $attrs = request()->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);

        if (!Auth::attempt($attrs)) {
            throw ValidationException::withMessages([
                'email'=> 'Maaf, email atau password yang anda masukkan salah.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');
    }

    public function destroy() {
        // if (Auth::guest()) {
        //     return response()->json([
        //         'success' => false,
        //         'code' => 401,
        //         'message' => "Tidak dapat logout sebelum login"
        //     ], 401);
        // }

        Auth::logout();

        return redirect('/');
    }
}
