<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return view('pages.user', ['user' => $request->user()]);
    }

    public function show(User $user)
    {
        return view('pages.user', ['user' => $user]);
    }

    public function showAdmin()
    {
        $users = User::get();
        return view('pages.admin',['users'=> $users]);
    }
}
