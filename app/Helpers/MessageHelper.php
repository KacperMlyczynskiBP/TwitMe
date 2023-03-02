<?php

namespace App\Helpers;

use App\Models\User;

class MessageHelper
{


    public static function addUserImageToMessage($messages){
        return $messages->filter(function ($message){
            return $message->user;
        })
            ->map(function ($message){
                $message['user_image_path']=$message->user->user_image_path;
                $message['username']=$message->user->username;
                return $message;
            });
    }
}
