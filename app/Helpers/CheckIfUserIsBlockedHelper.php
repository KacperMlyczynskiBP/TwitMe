<?php

namespace App\Helpers;

use App\Models\Blocked;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Bool_;

class CheckIfUserIsBlockedHelper
{

    public function getBlockedUser(User $user): User
    {
        return Blocked::where(['user_id' => Auth()->user()->id, 'blocked_user_id' => $user->id])->first();
    }


    public static function authorizeUser($id): bool
    {
        $loggedInUser = Auth()->user()->id;
        if ($id !== $loggedInUser) {
            $blockedUsers = GetBlockedUsersRealtion::getBlockedUserRelation($id);
            if (collect($blockedUsers)->isEmpty()) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
}



//        public static function checkUser($id): bool{
//            return Auth::check() && Auth()->user()->id !== $id;
//        }
