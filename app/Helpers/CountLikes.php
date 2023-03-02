<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class CountLikes
{

    public $count=0;
    public function countLikesOnTweets($postId){
        $likes=DB::table('likes')->where('post_id', $postId)->count();
        return $likes;
    }

    public function countLikesOnComments($commentId){
        $likes=DB::table('likes')->where('comment_id', $commentId)->count();
        return $likes;
    }
}
