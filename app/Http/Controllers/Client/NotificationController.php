<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(20);

        return view('client.notifications.index', compact('notifications'));
    }

    public function markAsRead($notificationId = null)
    {
        $user = auth()->user();

        if ($notificationId) {
            $user->unreadNotifications()
                ->where('id', $notificationId)
                ->markAsRead();
        } else {
            $user->unreadNotifications()->markAsRead();
        }

        return back()->with('success', 'Notifications marked as read.');
    }

    public function destroy($notificationId)
    {
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $notificationId)->firstOrFail();
        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }
}