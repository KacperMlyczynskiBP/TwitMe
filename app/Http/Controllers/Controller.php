<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Http\Services\TweetServices;
use App\Http\Services\UserService;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createPage(){
        $id=Auth()->user()->id;
        $followingUsers=DB::table('followers')->where('follower_user_id', $id)->get();
        $array=array();
        foreach($followingUsers as $users){
            $array[]=$users->user_id;
        }
        $posts=User::join('posts', 'users.id', '=', 'posts.user_id')
            ->whereIn('posts.user_id', $array)
            ->get();
        $user=User::findOrFail(Auth()->user()->id);
//        dd($posts);
        return view('index', compact('posts','user'));
    }

    public function search(\Illuminate\Http\Request $request){
       $results=DB::table('posts')->join('users', 'users.id', 'posts.user_id')
           ->where('body', 'LIKE', '%' . $request->body . '%' )->get()->all();
        $path=Auth()->user()->user_image_path;
        return view('searchResults', compact('results', 'path'));
    }
}
