<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class trends extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trends:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update trends everyday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $posts = Post::all();
//        $trends = [];
//
//        foreach ($posts as $post) {
//            $words = explode(' ', $post->body);
//            foreach ($words as $word) {
//                $word = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $word));
//                if (strlen($word) > 2) {
//                    if (isset($trends[$word])) {
//                        $trends[$word]++;
//                    } else {
//                        $trends[$word] = 1;
//                    }
//                }
//            }
//        }
//
//        arsort($trends);
//        $trends = array_slice($trends, 0, 10);
//
//        return $trends;
    }
}
