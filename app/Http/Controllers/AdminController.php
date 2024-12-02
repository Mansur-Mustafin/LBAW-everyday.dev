<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showAdmin(Request $request)
    {
        return view('pages.admin.admin');
    }

    public function showEditFormAdmin(User $user, Request $request)
    {
        return view('pages.admin.edit-user', ['user' => $user]);
    }

    public function showCreateFormAdmin(Request $request)
    {
        return view('pages.admin.create-user');
    }

    public function registerByAdmin(Request $request)
    {
        $credentials = $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => 'required|string|max:40',
            'email' => 'required|email|max:250|unique:user',
            'password' => 'required|min:4',
            'reputation' => 'required|integer',
            'is_admin'=>'required|string',
        ]);

        User::create([
            'username' => $credentials['username'],
            'public_name' => $credentials['public_name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'reputation' => $credentials['reputation'],
            'is_admin' => $credentials['is_admin']
        ]);

        return redirect()->route('admin')
            ->withSuccess('You have successfully created an account!');
    }
}
