<?php

namespace App\Http\Controllers;

use App\Models\NotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'follow' => 'boolean',
            'vote' => 'boolean',
            'post' => 'boolean',
            'comment' => 'boolean',
        ]);

        $user = Auth::user();

        NotificationSetting::where('user_id', $user->id)->update([
            'follow_notifications' => $validated['follow'],
            'vote_notifications' => $validated['vote'],
            'post_notifications' => $validated['post'],
            'comment_notifications' => $validated['comment'],
        ]);

        return response()->json(['success' => true, 'message' => 'Settings updated successfully']);
    }
}
