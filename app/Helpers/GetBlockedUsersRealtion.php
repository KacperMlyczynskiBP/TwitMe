<?php

namespace App\Helpers;

use App\Models\Blocked;
use App\Models\User;

class GetBlockedUsersRealtion
{


    public static function getBlockedUserRelation($id){
        $loggedInUser = Auth()->user()->id;

        $blockedUsers = Blocked::where(function ($query) use ($id, $loggedInUser){
            $query->where('user_id', $id)
                ->where('blocked_user_id', $loggedInUser);
        })
            ->orWhere(function ($query) use ($id, $loggedInUser){
                $query->where('user_id', $loggedInUser)
                    ->where('blocked_user_id', $id);
            })
            ->pluck('user_id', 'blocked_user_id')
            ->toArray();

        return $blockedUsers;
    }


    public static function getBlockedUserRelationByUsername($username){
        $usernameOfUser = User::select(['username','user_image_path','bio','id'])
            ->where('username', 'LIKE', '%' . $username . '%')
            ->pluck('username')
            ->first();
            $userId = User::where('username', $usernameOfUser)->pluck('id')->first();

          return self::getBlockedUserRelation($userId);
    }
}
