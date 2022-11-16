<?php

namespace App\Http\Controllers;

use App\Http\Services\ProfileService;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function createProfile(){
        $userTweets=DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')
            ->where('users.id', Auth()->user()->id)->get();
        return view('components.profileMaster', compact('userTweets'));
    }

    public function createProfileTweets(){
        $userTweets=DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')->where('posts.user_id',Auth()->user()->id)->get();
        return view('profileImproved', compact( 'userTweets'));
    }

    public function createProfileLikes(){
        $posts=(new ProfileService())->getPosts();
        return view('profileLikes', compact('posts'));
    }


}
