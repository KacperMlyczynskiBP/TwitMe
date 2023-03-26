<?php

namespace App\Http\Controllers;

use App\Jobs\ListNBADataJob;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ExploreController extends Controller
{
    public function explore(): View{
        $results = Cache::get('NBAResults');
        if($results === NULL){
            ListNBADataJob::dispatch();
            $results = Cache::get('NBAResults');
        }

        return view('explore', compact('results'));
    }
}
