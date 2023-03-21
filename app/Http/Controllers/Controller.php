<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Jobs\ListNBADataJob;
use App\Jobs\ListTrendsJob;
use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use function Termwind\renderUsing;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createPage(){
        $id=Auth()->user()->id;

        $followingUsers=DB::table('followers')
            ->where('follower_user_id', $id)
            ->get();

        $array=array();

        foreach($followingUsers as $users){
            $array[]=$users->user_id;
        }

        $posts=User::join('posts', 'users.id', '=', 'posts.user_id')
            ->whereIn('posts.user_id', $array)
            ->get();

        $user=User::findOrFail(Auth()->user()->id);

        $trends =  cache::get('trends');
        if($trends === NULL){
            $trends = [];
            ListTrendsJob::dispatch();
            $trends =  cache::get('trends');
        }

//        dd($posts);
        return view('index', compact('posts','user', 'trends'));
    }

    public function verificationFeatures(){
        return view('verificationFeatures');
    }


    public function search(\Illuminate\Http\Request $request){
       $results=Post::with('user')
           ->where('body', 'LIKE', '%' . $request->body . '%' )
           ->get()
           ->all();

        $path=Auth()->user()->user_image_path;

        return view('searchResults', compact('results', 'path'));
    }
}
