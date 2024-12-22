<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): View|Factory
    {
        return view('pages.notifications.notifications', ['settings' => Auth::user()->notificationSetting]);
    }

    public function getNotifications()
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
