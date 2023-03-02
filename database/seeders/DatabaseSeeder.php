<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
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
        Post::factory(25)->create();
        //         \App\Models\Post::factory(300)->create();
//        for($i=0; $i<100; $i++){
//            DB::table('followers')->insert([
//                'user_id'=>rand(100, 200),
//                'follower_user_id'=>rand(100,200)
//            ]);
//        }
    }
}
