<?php

namespace App\Jobs;

use App\Models\Discount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class cartUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $discount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Discount $discount)
    {
        $this->discount=$discount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cart=session::get('cart');
        $total=0;
        foreach(session('cart') as $cartId=> $cart){
            $total+=$cart['quantity']*$cart['price'];
        }
            $discountPrice=$this->discount->applyDiscount($total);
            $discountedPrice = ($total - $discountPrice);
            $discountInfo = array(
                'discountCode' => $this->discount['code'],
                'discountedPrice' => $discountedPrice,
            );
            session::put('discount', $discountInfo);
            session::save();

    }

}
