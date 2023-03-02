<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class CountFollowers
{
   public $count=0;

    public function countFollows($id){
        $userFollows=DB::table('followers')
            ->where('follower_user_id' , $id)
            ->count();
        return $userFollows;
    }

    public function countFollowers($id){
        $userFollowers=DB::table('followers')
            ->where('user_id', $id)
            ->count();
        return $userFollowers;
    }

}
