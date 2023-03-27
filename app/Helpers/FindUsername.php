<?php

namespace App\Helpers;

use App\Models\User;

class FindUsername
{
    public $username;

    public function findUsername($id)
    {
        $username=User::findOrFail($id);
        return $username['username'];
    }

    public function findOtherUserUsername($message)
    {
        $id=Auth()->user()->id;
        if ($message->receiver_id == $id) {
            $otherUserId=$message->sender_id;
        } else {
            $otherUserId=$message->receiver_id;
        }

        if($id === $otherUserId){
            return Auth()->user()->username;
        }

        $otherUser = User::where('id', $otherUserId)
            ->where('id', '!=', $id)
            ->first();

        return $otherUser['username'];
    }
}
