<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\NewsPost;
use App\Models\Vote;
use App\Enums\ImageTypeEnum;
use App\Services\FileService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function show(Request $request)
    {
        return view('pages.admin.admin');
    }

    public function showEditForm(User $user, Request $request)
    {
        return view('pages.admin.edit-user', ['user' => $user]);
    }

    public function showCreateForm(Request $request)
    {
        return view('pages.admin.create-user');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => 'required|string|max:40',
            'email' => 'required|email|max:250|unique:user',
            'password' => 'required|min:4',
            'reputation' => 'required|integer',
            'is_admin' => 'required|string',
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

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        
        $validated = $request->validate([
            'public_name' => 'required|string|max:250',
            'username' => [
                'required',
                'string',
                'max:40',
                Rule::unique('user')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:250',
                Rule::unique('user')->ignore($user->id),
            ],
            'reputation' => 'nullable',
            'is_admin' => 'required|string',
            'new_password' => 'nullable|string|min:4',
            'remove_image' => 'required|string',
            'adm_password' => 'nullable|string'
        ]);

        if ($validated['is_admin'] == 'false' && $user->is_admin) { // case demote admin
            $adminPassword = env('ADMIN_SECRET_PASSWORD');

            if (!Hash::check($validated['adm_password'], $adminPassword)) {
                return redirect()->back()->withErrors(['adm_password' => 'The administrative password is incorrect.']);
            }
        } 

        $user->update([
            'reputation' => $validated['reputation'],
            'public_name' => $validated['public_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'is_admin' => $validated['is_admin'],
        ]);

        if ($request->hasFile('image') || $validated['remove_image'] == "true") {
            FileService::delete($user, ImageTypeEnum::PROFILE->value);
        }
        if ($request->hasFile('image')) {
            FileService::upload($request, $user, ImageTypeEnum::PROFILE->value);
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return redirect()->route('user.posts', ['user' => $user->id])
            ->withSuccess('You have successfully updated!');
    }
}
