<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Models\Bookmark;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function bookmarks(): View{
        $posts = Bookmark::where('user_id', Auth()->user()->id)->pluck('post_id')->toArray();

        if(!empty($posts)){
            $posts = Post::whereIn('id', $posts)->get();
            $posts = PostHelper::addUserImageToPost($posts);
        }

        return view('bookmarks', compact('posts'));
    }

    public function saveBookmark(int $postId): RedirectResponse{
        $bookmark = Bookmark::where('post_id', $postId)
            ->where('user_id', Auth()->user()->id)
            ->first();

        if(!$bookmark){
            $bookmark = new Bookmark();
            $bookmark->post_id = $postId;
            $bookmark->user_id = Auth()->user()->id;
            $bookmark->save();
        } else{
            $bookmark->delete();
        }

        return redirect()->back();
    }
}
