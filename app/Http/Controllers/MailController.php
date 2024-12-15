<?php

namespace App\Http\Controllers;

use App\Mail\MailModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class MailController extends Controller
{
    function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No user found with this email.']);
        }

        if (is_null($user->password)) {
            return redirect()->back()->withErrors(['email' => 'This account is linked with an Google OAuth provider and does not have a password.']);
        }

        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $mailData = [
            'email' => $request->email,
            'resetLink' => route('recover.reset', ['token' => $token, 'email' => $request->email]),
            'name' => $user->public_name,
        ];

        try {
            Mail::to($request->email)->send(new MailModel($mailData));
            return redirect()->route('login')->withSuccess('Email sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Our email recovery service is not avaliable now, try later.']);
        }
    }
}
