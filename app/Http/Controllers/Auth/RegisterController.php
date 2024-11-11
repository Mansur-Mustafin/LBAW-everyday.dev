<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'name' => 'required|string|max:250',
            'username' => 'required|string|max:40',
            'email' => 'required|email|max:250|unique:user',
            'password' => 'required|min:4|confirmed',
            'rank' => 'required|string|in:noobie,code monkey,spaghetti code chef,rock star,10x developer,404 error evader',
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'public_name' => $request->public_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rank' => $request->rank,
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        return redirect()->route('/home')
            ->withSuccess('You have successfully registered & logged in!');
    }
}
