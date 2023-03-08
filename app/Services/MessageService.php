<?php

namespace App\Services;

use App\Helpers\CheckIfUserIsBlockedHelper;
use App\Helpers\GetBlockedUsersRealtion;
use App\Helpers\MessageHelper;
use App\Models\Blocked;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class MessageService
{

    public function getUserById(int $id): User{
        return User::findOrFail($id);
    }

    public function getMessagesByUserId(int $id): Collection{

        $messages = Message::with('user')
            ->where(function ($query) use ($id) {
                $query->where('receiver_id', $id)
                    ->orWhere('sender_id', $id);
            })
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('messages')
                    ->groupBy('conversation_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $messages = MessageHelper::addUserImageToMessage($messages);

        return $messages;
    }

    public function getUsersByUsername(string $username){
        $blockedIDs = GetBlockedUsersRealtion::getBlockedUserRelationByUsername($username);
        $blockedUserIds = array_keys($blockedIDs);
        if(collect($blockedIDs)->isEmpty()){
            $users=User::select(['username','user_image_path','bio','id'])
                ->where('username', 'LIKE', '%' . $username . '%')
                ->get();
        } else{
            $users=User::select(['username','user_image_path','bio','id'])
                ->where('username', 'LIKE', '%' . $username . '%')
                ->whereNotIn('id', $blockedUserIds)
                ->get();

        }

        return $users;
    }

    public function getChatMessagesByUserAndId(int $id, User $user): Collection{
        $messages=Message::with('user')
            ->where(function($query) use ($id, $user){
                $query->where('receiver_id', $user->id);
                $query->where('sender_id', $id);
            })->orWhere(function($query) use ($id, $user){
                $query->where('receiver_id', $id);
                $query->where('sender_id', $user->id);
            })->orderBy('created_at', 'asc')
            ->get();

        $messages = MessageHelper::addUserImageToMessage($messages);

        return $messages;
    }

    public function storeConversationAndMessage($request): void{
        $id = $request['id'];
        $data = $request->validate(['message' => 'required']);
        $senderId = Auth()->user()->id;
        $receiverId = $id;


        $conversation = Conversation::whereHas('messages', function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)->where('receiver_id', $receiverId)
                ->orWhere('sender_id', $receiverId)->where('receiver_id', $senderId);
        })
            ->first();


        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->save();
        }

        $message = new Message();
        $message->text = $data['message'];
        $message->receiver_id = $receiverId;
        $message->sender_id = $senderId;
        $message->conversation_id = $conversation->id;
        $message->save();
    }


}

