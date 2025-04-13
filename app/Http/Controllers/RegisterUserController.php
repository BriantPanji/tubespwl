<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create() {
        if (Auth::check()) return redirect('/');
        return view('auth.register');
    }
    
    public function store() {
        $attrs = request()->validate([
            'displayName'=>['required', 'alpha_space'],
            'username'=>['required', 'unique:users,username', 'alpha_dash'],
            'email'=>['required', 'email'],
            'password'=>['required', Password::min(8)->letters()->numbers(), 'confirmed']
        ]);

        $user = User::create($attrs);

        Auth::login($user, true);

        return redirect('/');
    }


}
