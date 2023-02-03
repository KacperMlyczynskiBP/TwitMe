<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class DiscountController extends Controller
{
    // To do Dish should have discount_code->done if discount_code==active display on the page and apply discount to user if used
//    public $price_rules;
//
//    public function test(){
//        $price_rules=[
//            'AR2'=>['one_for_free'],
//            'BS2'=>['price_discount', $rule1, $rule2],
//        ];
//    }
//
//    public function getTotal(){
//       $cartProducts=Session::get('cart');
//
//       foreach($cartProducts as $product){
//          $rule=$this->price_rules[$product->discount_code] ?? NULL;
//
//          if($rule){
//              $total+={{$rule[0]}}[$rule[1]][$rule[2]];
//          }
//       }
//    }


//    public function one_for_free(){
//       return floor($dish->price=$dish->price/2);
//    }
//
//    public function price_discount(){
//
//    }

//    public function discount($total){
////         $input=$request->only('total','coupon');
////        dd($input);
//        if($this->discount_type == 'percentage'){
//            return $total*($this->percent_off/100);
//        } elseif($this->discount_type == 'fixed'){
//            return $total-($this->value);
//        }
//    }

}
