<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $google_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $google_user->getId())->first();

        if (!$user) {

            if (User::where('email', $google_user->getEmail())->exists()) {
                return redirect()->route('login')->withErrors(['google-email' => 'This email is already registered.']);
            }

            $base_username = explode('@', $google_user->getEmail())[0];
            $username = $base_username;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $base_username . $counter;
                $counter++;
            }

            $new_user = User::create([
                'username' => $username,
                'email' => $google_user->getEmail(),
                'google_id' => $google_user->getId(),
                'public_name' => $google_user->getName(),
            ]);

            Auth::login($new_user);
        } else {
            Auth::login($user);
        }

        return redirect()->route('news.recent');
    }
}
