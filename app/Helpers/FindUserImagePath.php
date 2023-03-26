<?php

namespace App\Helpers;

use App\Models\User;

class FindUserImagePath
{
    public $user_image_path;

    public function findOtherUserImagePath($message)
    {
           $id=Auth()->user()->id;
        if ($message->receiver_id == $id) {
            $otherId=$message->sender_id;
        } else {
            $otherId=$message->receiver_id;
        }
           $otherUser=User::where('id', $otherId)
               ->where('id', '!=', $id)
               ->first();
           return $otherUser->user_image_path;
    }
}
