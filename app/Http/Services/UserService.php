<?php

namespace App\Http\Services;

use App\Events\ConfirmationEvent;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Session;

class UserService
{

    public function getPosts(){
        $user=Auth()->user();
        $followers=$user->following->first();
        if(!$followers){
            $posts=DB::table('posts')->where('user_id', Auth()->user()->id)->get();
            return $posts;
        }
        $followers_id=$followers->pivot->follower_user_id;
        $posts=DB::table('posts')->join('followers', 'posts.user_id', '=', 'followers.user_id')
            ->where('followers.follower_user_id', $followers_id)->get();
        return $posts;
    }

    public function follow(Request $request){
        $user=User::find(Auth()->user()->id);
        $follower=DB::Table('followers')->where(['user_id'=>$request['user_id'], 'follower_user_id'=>Auth()->user()->id])->get()->first();
        if(!$follower){
            $user->following()->attach($request['user_id']);
            return redirect()->back();
        } else{
            $user->following()->detach($request['user_id']);
            return redirect()->back();
        }
    }
}
