<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Models\{Post, Collection, Bookmark};
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function bookmarks(): View
    {
        $posts = Bookmark::where('user_id', Auth()->user()->id)->pluck('post_id')->toArray();

        if (!empty($posts)) {
            $posts = Post::whereIn('id', $posts)->get();
            $posts = PostHelper::addUserImageToPost($posts);
        }

        return view('bookmarks', compact('posts'));
    }

    public function saveBookmark(Post $post): RedirectResponse
    {
        $bookmark = Bookmark::where('post_id', $post->id)
            ->where('user_id', Auth()->user()->id)
            ->first();

        if (!$bookmark) {
            $bookmark = new Bookmark();
            $bookmark->post_id = $post->id;
            $bookmark->user_id = Auth()->user()->id;
            $bookmark->save();
        } else {
            $bookmark->delete();
        }

        return redirect()->back();
    }

    public function collection()
    {
        $collections=Collection::all();
        $bookmarks=Bookmark::where('user_id', Auth()->user()->id);
        return view('collection', compact('collections', 'bookmarks'));
    }

    public function createCollection()
    {
        return view('createCollection');
    }

    public function deleteCollection()
    {

    }

    public function storeCollection($request)
    {
        $collection=new Collection();
        $collection->comment=$request->collection;
        $collection->user_id=Auth()->user()->id;
        $collection->save();
    }
}
