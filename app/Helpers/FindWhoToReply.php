<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\User;

class FindWhoToReply
{
   public $username;

    public function findWhoToReply($postId){
        $post=Post::findOrFail($postId);
        $userId=$post['user_id'];
        $user=User::findOrFail($userId);
        return  '@' . $user['username'];
    }

}
