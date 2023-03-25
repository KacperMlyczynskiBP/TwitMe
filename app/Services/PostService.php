<?php

namespace App\Services;

use App\Helpers\PostHelper;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use FFMpeg\FFProbe;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class PostService
{
    public function getUserById($id): User{
        return User::findOrFail($id);
    }

    public function getPostById($id): Post{
        return Post::findOrFail($id);
    }

    public function getCommentsById($id){
        try {
            $comments=Post::with('user')
                ->where('reply_id', $id)
                ->get();

            $comments=PostHelper::addUserImageToPost($comments);

            return $comments;
        } catch (QueryException $e) {
            return redirect()->back()->withErrors('query', 'There is an error' . ' ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors('model', 'There is an error' . ' ' . $e->getMessage());
        }
    }

    public function createPostData(array $data, $reply_id = NULL) {
        $user = Auth()->user();

        try {
            $post = new Post();
            $post->body = $data['body'];
            $post->user_id = $user->id;
            $post->reply_id = $reply_id;
            $post->image_path = $data['image_path'] ?? NULL;


            if (($data['tweetMedia'] ?? NULL) && $data['tweetMedia']->isValid()) {
                $mime_type = $data['tweetMedia']->getMimeType();

                if (strpos($mime_type, 'image') !== false) {
                    $this->handleImageUpload($data['tweetMedia'], $post);
                } elseif (strpos($mime_type, 'video') !== false) {
                    $this->handleVideoUpload($data['tweetMedia'], $post);
                }
            }
            $post->save();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors('query', 'There is an error' . ' ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors('model', 'There is an error' . ' ' . $e->getMessage());
        } catch (\Exception $e){
            return redirect()->back()->withErrors('exception', 'There is an error' . ' ' . $e->getMessage());
        }

    }

    public function likeTweet($postId, $userId) {
        $id=Auth()->user()->id;
        $user=User::findOrFail($id);

        try {
            $like=$user->likes()
                ->where('post_id', $postId)
                ->first();

            if(!$like){

                $user->likes()->attach($postId);
                DB::table('posts')->where('id', $postId)->increment('likes_count');


                $user = User::findOrFail($userId);
                $loggedUser = Auth()->user();

                if($loggedUser->blue_verified == 1 && $user->id !== Auth()->user()->id){
                    $notification = new Notification();
                    $notification->sender_id = Auth()->user()->id;
                    $notification->receiver_id = $user->id;
                    $notification->type = 'App\Models\Like';
                    $notification->from_verified = true;
                    $notification->comment = ' Liked your post';
                    $notification->save();

                } elseif($user->id !== Auth()->user()->id){

                    $notification = new Notification();
                    $notification->sender_id = Auth()->user()->id;
                    $notification->receiver_id = $user->id;
                    $notification->type = 'App\Models\Like';
                    $notification->comment = ' Liked your post';
                    $notification->save();
                }
            }else{
                $user->likes()->detach($postId);
                DB::table('posts')->where('id', $postId)->decrement('likes_count');
            }
        } catch (QueryException $e) {
            return redirect()->back()->withErrors('query', 'There is an error' . ' ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors('model', 'There is an error' . ' ' . $e->getMessage());
        }
    }


    private function handleImageUpload($file, Post $post){
        $fileName = $file->getClientOriginalName();
        $file->move('images', $fileName);
        $post->image_path = $fileName;
    }

    private function handleVideoUpload($file, Post $post){

            $ffprobe = FFProbe::create([
                'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
                'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe'
            ]);

            $duration = $ffprobe->format(public_path('images/' . $file->getClientOriginalName()))->get('duration');

            if (Auth()->user()->blue_verified == 1) {
                if ($duration > 600) {
                    return redirect()->back()->withErrors(['duration' => 'You cannot post a video longer than 600s']);
                }
            } else {
                if ($duration > 60) {
                    return redirect()->back()->withErrors(['duration' => 'You cannot post a video longer than 60s']);
                }
            }
            $this->handleImageUpload($file, $post);
    }

}
