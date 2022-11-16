<?php

namespace App\Http\Controllers;

use App\Http\Requests\tweetRequest;
use App\Http\Services\TweetServices;
use App\Http\Services\UserService;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createPage(){
        $posts=(new UserService())->getPosts();
        return view('index', compact('posts'));
    }

    public function search(\Illuminate\Http\Request $request){
        $results=Post::where('body', 'LIKE', '%' . $request->body . '%')->get()->all();
//        dd($results);
        return view('searchResults', compact('results'));
    }
}
