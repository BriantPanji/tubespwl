<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        if (Auth::check())
            return redirect('/');
        return view('auth.register');
    }

    public function store()
    {
        $attrs = request()->validate([
            'display_name' => ['required', 'alpha_space'],
            'username' => ['required', 'unique:users,username', 'alpha_dash'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)->letters()->numbers(), 'confirmed']
        ]);

        $user = User::create($attrs);

        Auth::login($user, true);

        return redirect('/');
    }

    // Method untuk tampilkan form edit profile
    public function edit()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('profile.edit', compact('user')); // Kirim data user ke view
    }

    // Method untuk update data profile
    public function update(Request $request)
    {   
        $user = Auth::user();

        // Validasi inputan
        $validated = $request->validate([
            'display_name' => ['required', 'alpha_space'],
            'username' => ['required', 'unique:users,username,' . $user->id, 'alpha_dash'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // avatar tidak wajib
        ]);



        // Update data profil: display_name, username
        $user->update([
            'display_name' => $validated['display_name'],
            'username' => $validated['username'],
        ]);

        // Update password jika diisi
        if ($request->password) {
            $user->update([
                'password' => bcrypt($validated['password']), // Enkripsi password baru
            ]);
        }

        // Cek apakah ada avatar yang di-upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->update([
                'avatar' => $avatarPath, // Simpan path avatar baru
            ]);
        }

        // Setelah berhasil, redirect ke halaman edit profile dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui !');
    }
}
