<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;

class CountFollowers
{
   public $count=0;

    public function countFollows(){
        $userFollows=DB::table('followers')->where('follower_user_id', Auth()->user()->id)->count();
        return $userFollows;
    }

    public function countFollowers(){
        $userFollowers=DB::table('followers')->where('user_id', Auth()->user()->id)->count();
        return $userFollowers;
    }

}
