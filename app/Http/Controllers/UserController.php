<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return view('pages.me', ['user' => $request->user()]);
    }

    public function show(User $user)
    {
        return view('pages.user', ['user' => $user]);
    }
}
