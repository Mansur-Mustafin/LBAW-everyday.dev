<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordRecoverController extends Controller
{
    public function showRecoverForm(): View|Factory
    {
        return view('auth.recover');
    }

    public function showResetPasswordForm(Request $request): View|Factory
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        return $this->validateResetToken($validated['email'], $validated['token'])
            ? view('auth.reset', ['email' => $validated['email'], 'token' => $validated['token']])
            : view('errors.invalid-link');
    }

    public function recover(Request $request): RedirectResponse
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

    private function validateResetToken(string $email, string $token): bool
    {
        $resetEntry = DB::table('password_resets')->where('email', $email)->first();

        // TODO:: recheck
        // if (
        //     !$resetEntry ||
        //     !Hash::check($token, $resetEntry->token) ||
        //     Carbon::now()->diffInMinutes(Carbon::parse($resetEntry->created_at)) > 5
        // ) {
        //     return false;
        // }
        //
        // return true;

        return (
            $resetEntry &&
            Hash::check($token, $resetEntry->token) &&
            !Carbon::now()->diffInMinutes(Carbon::parse($resetEntry->created_at)) > 5
        );
    }
}
