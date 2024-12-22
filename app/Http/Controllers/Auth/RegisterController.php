<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        User::create($credentials);

        Auth::attempt([
            'email' => $credentials['email'],
            'password' => $request->input('password')
        ]);

        $request->session()->regenerate();

        return redirect()->route('news.recent')
            ->withSuccess('You have successfully registered & logged in!');
    }
}
