<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordRecoverController extends Controller
{
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
