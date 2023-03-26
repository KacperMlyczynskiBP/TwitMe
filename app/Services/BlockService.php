<?php

namespace App\Services;

use App\Helpers\GetBlockedUsersRealtion;
use App\Models\Blocked;
use App\Models\Conversation;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BlockService
{

    public function getBlockedUser(User $user): ?Blocked
    {
        return Blocked::where(['user_id'=>Auth()->user()->id, 'blocked_user_id'=> $user->id])->first();
    }

    public function deleteConversationAndMessages(User $user): void
    {
        $id = Auth()->user()->id;
        $userId = $user->id;

        DB::Transaction(function () use ($userId, $id) {

            Follower::where(function ($query) use ($id, $userId) {
                $query->where('user_id', $id)
                    ->where('follower_user_id', $userId);
            })
                ->orWhere(function ($query) use ($id, $userId) {
                    $query->where('user_id', $userId)
                        ->where('follower_user_id', $id);
                })
                ->delete();

            Message::where(function ($query) use ($id, $userId) {
                $query->where('sender_id', $id)
                    ->where('receiver_id', $userId);
            })
                ->orWhere(function ($query) use ($id, $userId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $id);
                })
                ->delete();

            Conversation::whereIn('id', function ($query) use ($id, $userId) {
                $query->select('conversation_id')
                    ->from('messages')
                    ->where(function ($q) use ($id, $userId) {
                        $q->where('sender_id', $id)
                            ->where('receiver_id', $userId);
                    })
                    ->orWhere(function ($q) use ($id, $userId) {
                        $q->where('sender_id', $userId)
                            ->where('receiver_id', $id);
                    });
            })->delete();
        });
    }
}
