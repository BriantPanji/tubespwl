<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;

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
        $valMess = [
            'display_name.required' => 'Nama tampilan tidak boleh kosong',
            'display_name.alpha_space' => 'Nama tampilan hanya boleh mengandung huruf dan spasi',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, garis bawah, dan tanda hubung',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ];

        $attrs = request()->validate([
            'display_name' => ['required', 'alpha_space'],
            'username' => ['required', 'unique:users,username', 'regex:/^[a-zA-Z0-9._-]+$/', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)->letters()->numbers(), 'confirmed']
        ], $valMess);

        $user = User::create($attrs);

        Auth::login($user);

        // Kirim email verifikasi
        event(new Registered($user));

        // Jangan login dulu, arahkan ke halaman verifikasi
        return redirect()->route('verification.notice')
            ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi.');
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
            'username' => ['required', 'unique:users,username,' . $user->id, 'regex:/^[a-zA-Z0-9._-]+$/'],
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
//            $avatarPath = $request->file('avatar')->store('', 'avatars');
            $avatarPath = $request->file('avatar')->store('avatars', 'public'); // Simpan di disk 'public' pada folder 'avatars'
            $user->update([
                'avatar' => $avatarPath, // Simpan path avatar baru
            ]);
        }

        // Setelah berhasil, redirect ke halaman edit profile dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui !');
    }

    public function showOther($id)
    {
        $user = User::findOrFail($id); // atau pakai `where('id', $id)->firstOrFail()`

        // Hitung data aktivitas pengguna
        $myposts = Post::where('user_id', $id)->with('attachments')->get();
        $postCount = $user->posts()->count();
        $commentCount = $user->comments()->count();
        $badgeCount = $user->badges()->count();
        $postVoteCount = $user->votedPost()->count(); // Pastikan relasi ini ada
        $bookmarkCount = $user->bookmarks()->count();  // Pastikan relasi ini juga ada

        return view('profile.other', compact(
            'user',
            'myposts',
            'postCount',
            'commentCount',
            'badgeCount',
            'postVoteCount',
            'bookmarkCount'
        ));
    }
}
