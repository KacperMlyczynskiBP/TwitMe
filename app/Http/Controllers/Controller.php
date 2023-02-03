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
        $posts=(new UserService())->getPosts();
//        dd($posts);
        $user=User::findOrFail(Auth()->user()->id);
        return view('index', compact('posts','user'));
    }

    public function search(\Illuminate\Http\Request $request){
       $results=DB::table('posts')->join('users', 'users.id', 'posts.user_id')
           ->where('body', 'LIKE', '%' . $request->body . '%' )->get()->all();
        $path=Auth()->user()->image_path;
        return view('searchResults', compact('results', 'path'));
    }
}
