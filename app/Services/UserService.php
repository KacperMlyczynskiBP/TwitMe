<?php

namespace App\Http\Services;

use App\Events\ConfirmationEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserService
{

    public function getPosts(){
        $user=Auth()->user();
        $followers=$user->following->first();
        if(!$followers){
          $posts=DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->where('user_id', Auth()->user()->id)->get();
            return $posts;
        } else{
            //do it here
        $followers_id=$followers->pivot->follower_user_id;
        $posts=DB::table('posts')
            ->join('followers', 'posts.user_id', '=', 'followers.user_id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('followers.follower_user_id', $followers_id)->get();
        return $posts;
        }
    }

    public function follow(Request $request){
        $user=User::find(Auth()->user()->id);
        $follower=DB::Table('followers')->where(['user_id'=>$request['user_id'], 'follower_user_id'=>Auth()->user()->id])->get()->first();

        if(Auth()->user()->id == $request['user_id']){
            return redirect()->back();
        } else {
            if(!$follower){
                $user->following()->attach($request['user_id']);
                return redirect()->back();
            } else{
                $user->following()->detach($request['user_id']);
                return redirect()->back();
            }
        }
    }
}
