<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('pages.notifications', ['settings' => Auth::user()->notificationSetting]);
    }

    public function getNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $unreadNotificationIds = $notifications->where('is_viewed', false)->pluck('id');
        if ($unreadNotificationIds->isNotEmpty()) {
            Notification::whereIn('id', $unreadNotificationIds)->update(['is_viewed' => true]);
        }

        return response()->json([
            'data' => $notifications->items(),
            'next_page' => $notifications->currentPage() + 1,
            'last_page' => $notifications->lastPage(),
        ]);
    }
}
