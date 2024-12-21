<?php

namespace App\Http\Controllers;

use App\Enums\ImageTypeEnum;
use App\Http\Controllers\ChartController;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Http\Requests\User\AdminUpdateRequest;
use App\Models\User;
use App\Services\FileService;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function show()
    {
        $usersChart = ChartController::usersChart();
        $newsPostsChart = ChartController::newsChart();
        return view('pages.admin.dashboard', ['users' => $usersChart, 'news_posts' => $newsPostsChart]);
    }

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
        try {
            $user->update([
                'status' => 'blocked'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User could not be banned, an error occurred.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'You have successfully banned a user'
        ]);
    }

    public function unblockUser(User $user)
    {
        try {
            $user->update([
                'status' => 'active'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User could not be unbanned, an error occurred.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'You have successfully unbanned the user.'
        ]);
    }
}
