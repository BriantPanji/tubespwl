<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        if (Auth::check()) return redirect('/');
        $mode = request()->query('m', 'email');
        return view('auth.login', compact('mode'));
    }

    public function store()
    {
        if (Auth::check()) {
            return response()->json([
                'success' => false,
                'code' => 403,
                'message' => "Tidak dapat login dua kali"
            ], 403);
        }

        request()->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $creds = [
            $field => $login,
            'password' => request()->input('password')
        ];

        if (!Auth::attempt($creds, true)) {
            throw ValidationException::withMessages([
                'login' => 'Maaf, ' . $field . ' atau password yang anda masukkan salah.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');
    }

    public function forget_password_view()
    {
        $mode = request()->query('m', 'email');
        return view('auth.forget-password', compact('mode'));
    }

    public function forget_password(Request $request)
    {
        // @dd($request->query('m'));
        $login = $request->query('m');
        $request->validate([
            $login => ['required'],
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^[a-zA-Z0-9]+$/'],
        ], [
            $login . '.required' => ucfirst($login) . ' tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal harus 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.regex' => 'Password hanya boleh mengandung huruf dan angka (tanpa simbol)',
        ]);

        if ($login == 'email') {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'Email tidak terdaftar']);
            }
        } else {
            $user = User::where('username', $request->username)->first();
            if (!$user) {
                return back()->withErrors(['username' => 'Username tidak terdaftar']);
            }
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

    public function destroy()
    {
        // if (Auth::guest()) {
        //     return response()->json([
        //         'success' => false,
        //         'code' => 401,
        //         'message' => "Tidak dapat logout sebelum login"
        //     ], 401);
        // }

        Auth::logout();

        return redirect('/login');
    }
}
