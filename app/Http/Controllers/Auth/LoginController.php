<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{

    /**
     * Display a login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('news.recent')
            ->withSuccess('You have logged out successfully!');
    }

    public function showRecoverForm(Request $request)
    {
        return view('auth.recover');
    }

    public function showResetPasswordForm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        if (!$this->validateResetToken($validated['email'], $validated['token'])) {
            return view('errors.invalid-link');
        }

        return view('auth.reset', ['email' => $validated['email'], 'token' => $validated['token']]);
    }

    public function recover(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);

        if (!$this->validateResetToken($validated['email'], $validated['token'])) {
            return view('errors.invalid-link');
        }

        User::where('email', $validated['email'])
            ->update(['password' => Hash::make($validated['password'])]);

        DB::table('password_resets')->where('email', $validated['email'])->delete();

        return redirect()->route('login')->withSuccess('Password reset successfully!');
    }

    private function validateResetToken(string $email, string $token)
    {
        $resetEntry = DB::table('password_resets')->where('email', $email)->first();

        if (!$resetEntry || !Hash::check($token, $resetEntry->token)) {
            return false;
        }

        $tokenCreatedTime = Carbon::parse($resetEntry->created_at);
        if (Carbon::now()->diffInMinutes($tokenCreatedTime) > 5) {
            return false;
        }

        return $resetEntry;
    }
}
