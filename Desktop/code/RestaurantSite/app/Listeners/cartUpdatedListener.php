<?php

namespace App\Listeners;

use App\Jobs\cartUpdated;
use App\Models\Discount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class cartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $discountCode = session::get('discount')['discountCode'];
        if($discountCode){
//            dd('wworkl');
            $discount = Discount::where('code', $discountCode)->firstOrFail();
            cartUpdated::dispatch($discount);
        }
    }
}
