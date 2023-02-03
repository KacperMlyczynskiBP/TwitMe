<?php

namespace App\Http\Controllers;
use App\Jobs\cartUpdated;
use App\Models\Discount;
use Illuminate\Support\Facades\Event;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $total=0;

    public function showCart(){
        $cart = Session::get('cart');
//        Session::flush();

        return view('cart', compact('cart'));
    }


    public function addToCart(Request $request){
        $input=$request->all();
        $cartItems=Cart::all();
        $product=Dish::find($request->product_id);
        $cartId=$request->product_id;
//        $cartDB=new Cart($input);
//        $cartDB=Cart::find(1);
        $cart = Session::get('cart');
//        $product=$cart[$cartId];
        $discountSession=Session::get('discount');
//        dd($cart);

//        $cartItem=Cart::create(['price'=>$product->price, 'quantity'=>1, 'name'=>$product->name]);
//        dd($cartItem);
//        dd($discountSession);
//        session::forget('discount');
//        session::forget('cart');
//        session::flush();
//        session::save();
//        dd($product);
// dd($cart);
        if(!$cart){

            $cart =
                [
                    $cartId => [
                        'cartId'=>$product->id,
                        'name'=>$product->name,
                        'quantity'=> 1,
                        'price'=>$product->price,
                        'total'=>$product->price,
                    ]
                ];
            Session::put('cart', $cart);
            if($discountSession){
                $discountCode=Session::get('discount')['discountCode'];
                $discount=Discount::where('code', $discountCode)->firstOrFail();
                event(new \App\Events\cartUpdated($discount));
//            cartUpdated::dispatch($discount);
//            cartUpdated::dispatch($discount);
            }

            return redirect()->route('cart');
        }
        //if there is already item in cart increment
        if(isset($cart[$cartId])){
            $cart[$cartId]['quantity']++;
            $cart[$cartId]['total']+=$cart[$cartId]['price']*$cart[$cartId]['quantity'];
            $cart=Session::put('cart', $cart);
//             dd(session('cart'));
            if($discountSession){
                $discountCode=Session::get('discount')['discountCode'];
                $discount=Discount::where('code', $discountCode)->firstOrFail();
                event(new \App\Events\cartUpdated($discount));
//            cartUpdated::dispatch($discount);
//            cartUpdated::dispatch($discount);
            }
            return redirect()->route('cart');

        }

        //if cart exists but the item in cart is not existent yet
        $cart[$cartId]=[
            'name'=>$product->name,
            'price'=>$product->price,
            'cartId'=>$product->id,
            'quantity'=>1,
            'total'=>$product->price,
        ];

        Session::put('cart', $cart);
//        return redirect()->route('cart');
//        dd(session('cart'));
        if($discountSession){
            $discountCode=Session::get('discount')['discountCode'];
            $discount=Discount::where('code', $discountCode)->firstOrFail();
          event(new \App\Events\cartUpdated($discount));
//            cartUpdated::dispatch($discount);
//            cartUpdated::dispatch($discount);
        }


        return view('cart', compact('cartItems', 'product', 'cart'));



    }


    public function discount(Request $request){
        $input=$request->only('coupon', 'total');
        $discountCode=$input['coupon'];
        $total=$input['total'];
        $cart=session::get('cart');
        $discount=Discount::where('code', $discountCode)->firstOrFail();
        if(!$discount){
                return back();
            }
//            elseif($discount->discount_type == 'fixed'){
//                return $discount->value;
//            }
        cartUpdated::dispatch($discount);
//          event(new \App\Events\cartUpdated($discount));
        return redirect()->route('cart');
    }

    public function deleteDiscount(){
         session::forget('discount');
         return redirect()->route('cart');
    }





//    public function returnTotalQuantity($cart){
//        $quantity=$cart[$cartIdid]['quantity']+=$cart[$cartId]['quantity'];
//    }


//    public function updateCart(Request $request){
//
//        if($request->id && $request->quantity){
//            $cart=Session::get('cart');
//            $cart[$request->cartId]['quantity'] = $request->quantity;
//            Session::put('cart', $cart);
//        }
//        return view('cart', compact('cart'));
//
//    }


//    public function increaseQuantity(){
//        $cart=Session::get('cart');
//        dd($cart);
//    }
}
