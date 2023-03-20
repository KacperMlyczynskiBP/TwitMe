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

    public function









}
