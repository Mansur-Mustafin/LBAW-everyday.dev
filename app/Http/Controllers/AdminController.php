<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Http\Requests\User\AdminUpdateRequest;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showUsers()
    {
        return view('pages.admin.admin', ['show' => 'users']);
    }

    public function showEditForm(User $user)
    {
        return view('pages.admin.edit-user', ['user' => $user]);
    }

    public function showCreateForm()
    {
        return view('pages.admin.create-user');
    }

    public function register(AdminRegisterRequest $request)
    {
        $credentials = $request->validated();

        User::create($credentials);

        return redirect()->route('admin')
            ->withSuccess('You have successfully created an account!');
    }

    public function update(User $user, AdminUpdateRequest $request)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

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

    public function blockUser(User $user)
    {
        $user->update([
            'status' => 'blocked'
        ]);

        return response()->json([
            'sucess' => 'You have successfully banned a user'
        ]);
    }

    public function unblockUser(User $user)
    {
        $user->update([
            'status' => 'active'
        ]);

        return response()->json([
            'sucess' => 'You have successfully unbanned a user'
        ]);
    }
}
