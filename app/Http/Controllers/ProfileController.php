<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateUserRequest;
use App\Http\Services\ProfileService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function createProfile($id){
        $userTweets=DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.user_id', $id)->get();
        $user=User::findOrFail($id);
         return view('profile.profileImproved', compact('userTweets', 'user'));
    }

    public function createProfileTweets($id){
        $userTweets=DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')->where('posts.user_id', $id)->get();
        $user=User::findOrFail($id);
        return view('profile.profileImproved', compact( 'userTweets','user'));
    }

    public function createProfileLikes($id){
        $user=User::findOrFail($id);
        $posts=(new ProfileService())->getPosts($id);
        return view('profile.profileLikes', compact('posts', 'user'));
    }

    public function createProfileTweetsReplies($id){
        $userTweets=(new ProfileService())->getUserTweets($id);
        $user=User::findOrFail($id);
        return view('profile.tweetsReplies', compact('userTweets', 'user'));
    }

    public function createProfileEdit($id){
        $user=User::findOrFail($id);
        return view('profile.profileEdit', compact('user'));
    }

    public function createProfileFollowers($id){
        $user_id='user_id';
        $followers=(new ProfileService())->getFollowers($id,$user_id);
        return view('followers', compact('followers'));
    }

    public function createProfileFollowing($id){
        $user_id='follower_user_id';
        $following=(new ProfileService())->getFollowers($id,$user_id);
        return view('following', compact('following'));
    }

    public function updateUser(updateUserRequest $request){
       $user=(new ProfileService())->updateUser($request);
       return redirect()->route('create.profile', ['id'=>Auth()->user()->id]);
    }

    public function deletePicture(){
        $user=User::findOrFail(Auth()->user()->id);
        $user->update(['user_image_path'=>NULL]);
        return redirect()->route('create.profile', ['id'=>Auth()->user()->id]);
    }


}
