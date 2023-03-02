<?php

namespace App\Jobs;

use App\Models\Post;
use App\Services\TrendService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ListTrendsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


            $posts = Post::all();
            $trends = [];

            foreach ($posts as $post) {
                $words = explode(' ', $post->body);
                foreach ($words as $word) {
                    $word = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $word));
                    if (strlen($word) > 2) {
                        if (isset($trends[$word])) {
                            $trends[$word]++;
                        } else {
                            $trends[$word] = 1;
                        }
                    }
                }
            }

            arsort($trends);

            $trends = array_slice($trends, 0, 10);

            Cache::remember('trends', 86400, function () use ($trends) {
               return $trends;
            });

    }
}
