<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class Checkout extends Controller
{

    public $total=0;
    public $price_rules;

    public function __construct($price_rules)
    {
        $this->price_rules=$price_rules;
    }

    public function scan(string $item){

        $product=Product::findOrFail('product_code', $item);
        Cart::create(['product_id', $product->id]);
        $this->total=$this->getTotal();
    }

//$price_rules = [
//'FR1'=>['get_one_free', NULL, NULL],
//'CF1'=>['coffee'],
//'SR1'=>['strawberries', 3, '4.50'],
//];

    public function getTotal(){

        $cart_products=Cart::query()
            ->join('products', 'carts.product_id', '=', 'carts')
            ->selectRaw('products.id, products.price,sum(carts.quantity)')
            ->groupBy('products.product_cde', 'products.price')->get();

        foreach($cart_products as $product){
            $rule=$this->price_rules[$product->product_code] ?? NULL;
            if(!is_null($rule)){
                $total+=$this->{$rule[0]}($product, $rule[1], $rule[2]);
            } else{
                $total+=$product->quantity*$product->price;
            }

        }
        return $total;
    }
    //$price_rules = [
//'FR1'=>['get_one_free', NULL, NULL],
//'CF1'=>['coffee'],
//'SR1'=>['bulk_discount', 3, '4.50'],
//];

    private function get_one_free($product, $rule1, $rule2){
        $quantity= floor($product->quantity/2)+$product->quantity%2;
        return $quantity*$product->price;
    }

    private function bulk_discount($product, $rule1, $rule2){
        $price=$product->price;
        if($product->quantity >= 3){
            $price=$rule2;
        }
        return $product->quantity*$price;
    }


}
