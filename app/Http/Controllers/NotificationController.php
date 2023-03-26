<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function notifications(): View
    {
        $notifications = Notification::where('receiver_id', Auth()->user()->id)->get();

        return view('notifications', compact('notifications'));
    }

    public function notificationsVerified(): View
    {
        $notifications = Notification::where(['receiver_id'=>Auth()->user()->id, 'from_verified'=>1])->get();

        return view('notification.notificationVerified', compact('notifications'));
    }

    public function notificationsMentions()
    {
      //mentions not ready
    }
}
