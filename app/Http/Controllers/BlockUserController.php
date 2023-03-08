<?php

namespace App\Http\Controllers;

use App\Helpers\CheckIfUserIsBlockedHelper;
use App\Helpers\GetBlockedUsersRealtion;
use App\Models\Blocked;
use App\Models\Conversation;
use App\Models\Follower;
use App\Models\Message;
use App\Models\User;
use App\Services\BlockService;
use Illuminate\Http\RedirectResponse;

class BlockUserController
{
    protected $blockService;

    public function __construct(BlockService $blockService){
        $this->blockService = $blockService;
    }

    public function blockUser(User $user): RedirectResponse{
        // look for blockedUsers if there are none then block $user If there is a record then unblock

        $id = Auth()->user()->id;
        $blockedUser = $this->blockService->getBlockedUser($user);

        if(!$blockedUser){
            Auth()->user()->blockedUsers()->attach($user->id);
            $this->blockService->deleteConversationAndMessages($user);
        } else{
            Auth()->user()->blockedUsers()->detach($user->id);
        }

        return redirect()->route('create.profileTweets', ['id'=>$id]);

    }

}

