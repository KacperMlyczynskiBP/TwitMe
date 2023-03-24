<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blocked;
use App\Models\Bookmark;
use App\Models\Conversation;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Post;
use App\Models\TweetView;
use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(500)->create();
        Post::factory(1000)->create();
        Blocked::factory(50)->create();
        Bookmark::factory(400)->create();
        Like::factory(10000)->create();
        Follower::factory(10000)->create();
        Conversation::factory(1000)->create();
        Message::factory(1000)->create();
        Notification::factory(1000)->create();
//        TweetView::factory(1000)->create();
    }
}
