<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ListNBADataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            $date = Carbon::now()->format('Y-m-d');
            $response = Http::withHeaders([
            'x-rapidapi-host' => 'v1.basketball.api-sports.io',
            'x-rapidapi-key' => config('services.rapid.key'),
             ])->get("https://v1.basketball.api-sports.io/games?date=$date");
            $results = collect($response->json(['response']))
                ->filter(function ($game) {
                    return $game['league']['name'] === 'NBA';
                });
            Cache::remember('NBAResults', 8600, function () use ($results) {
                       return $results;
            });
    }
}
