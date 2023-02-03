<?php

namespace App\Http\Livewire;
use App\Models\Discount;
use App\Models\Dish;
use Illuminate\Support\Facades\Session;


use Livewire\Component;

class Counter extends Component
{
    public $cartId;

    public function mount($cartId){
        $this->cartId=$cartId;
    }

    public function decrement($cartId){
            $cart=Session::get('cart');
            if(isset($cart[$cartId])){
               $cart[$cartId]['quantity']--;
                Session::put('cart', $cart);
                if (session('discount')) {
                    $discountSession = Session::get('discount');
                    $discount=Discount::where('code', $discountSession['discountCode'])->firstOrFail();
                    event(new \App\Events\cartUpdated($discount));
                }
                }
                return redirect()->route('cart');
            }

    public function increment($cartId)
    {
        $cart = Session::get('cart');
        $total = 0;
        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity']++;
            Session::put('cart', $cart);
            if (session('discount')) {
                $discountSession = Session::get('discount');
                    $discount=Discount::where('code', $discountSession['discountCode'])->firstOrFail();
                    event(new \App\Events\cartUpdated($discount));
            }
            return redirect()->route('cart');

        }
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
