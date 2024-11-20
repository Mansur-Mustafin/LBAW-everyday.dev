<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\View\View;

use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a login form.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => 'required|string|max:40',
            'email' => 'required|email|max:250|unique:user',
            'password' => 'required|min:4|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'public_name' => $request->public_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }
}
