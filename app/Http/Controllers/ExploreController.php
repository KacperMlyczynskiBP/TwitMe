<?php

namespace App\Http\Controllers;

use App\Jobs\ListNBADataJob;
use Illuminate\Support\Facades\Cache;

class ExploreController extends Controller
{
    public function explore(){
        $results = Cache::get('NBAResults');
        if($results === NULL){
            ListNBADataJob::dispatch();
            $results = Cache::get('NBAResults');
        }
        dd($results);
        return view('explore', compact('results'));
    }}
