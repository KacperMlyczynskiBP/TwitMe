<?php

namespace App\Http\Controllers;

use App\Helpers\MessageHelper;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        $notifications = Notification::where('receiver_id', Auth()->user()->id)->get();

        return view('notifications', compact('notifications'));
    }

    public function notificationsVerified(){
        $notifications = Notification::where(['receiver_id'=>Auth()->user()->id, 'from_verified'=>1])->get();

        return view('notification.notificationVerified', compact('notifications'));
    }

    public function notificationsMentions(){
      //mentions not ready
    }








}
