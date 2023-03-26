<?php

namespace App\Http\Controllers;


use App\Helpers\PaginateHelper;
use App\Helpers\PostHelper;
use App\Jobs\ListTrendsJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createPage(): View{
        $id=Auth()->user()->id;

        $followingUserIds = DB::table('followers')
            ->where('follower_user_id', $id)
            ->pluck('user_id')
            ->toArray();

        $followersPosts = Post::with('user')
            ->whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        $mostPopularPosts=Post::with('user')
            ->orderBy('likes_count', 'desc')
            ->get();

        $postsBefore = $followersPosts->merge($mostPopularPosts)->unique('id');

        $posts = $postsBefore->sortByDesc('created_at');

        $posts = PostHelper::addUserImageToPost($posts);

        $posts = PaginateHelper::paginate($posts);

        $user=User::findOrFail(Auth()->user()->id);

        $trends =  cache::get('trends');

        if($trends === NULL){
            $trends = [];
            ListTrendsJob::dispatch();
            $trends =  cache::get('trends');
        }

        return view('index', compact('posts','user', 'trends'));
    }

    public function verificationFeatures(): View{
        return view('verificationFeatures');
    }


    public function search(\Illuminate\Http\Request $request): View{
       $results=Post::with('user')
           ->where('body', 'LIKE', '%' . $request->body . '%' )
           ->get()
           ->all();

        $path=Auth()->user()->user_image_path;

        return view('searchResults', compact('results', 'path'));
    }
}
