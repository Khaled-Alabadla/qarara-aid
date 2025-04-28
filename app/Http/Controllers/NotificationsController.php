<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function markAsRead(DatabaseNotification $notification)
    {
        // Mark the notification as read
        $notification->markAsRead();

        // Redirect to the assistance page
        return redirect()->route('assistances.user', Auth::id());
    }
}
