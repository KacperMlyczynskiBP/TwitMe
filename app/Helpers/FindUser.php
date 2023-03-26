<?php

namespace App\Helpers;

use App\Models\User;

class FindUser
{
    public $user;

    public function findUser($message)
    {
        $id=Auth()->user()->id;
        if ($message->receiver_id == $id) {
            $otherId=$message->sender_id;
        } else {
            $otherId=$message->receiver_id;
        }
        $user=User::where('id', $otherId)
          ->where('id', '!=', $id)
          ->first();
        return $user;
    }
}
