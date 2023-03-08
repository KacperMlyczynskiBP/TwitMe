<?php

namespace App\Services;

use App\Events\ConfirmationEvent;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserService
{
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
