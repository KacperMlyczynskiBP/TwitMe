<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('discount_1type');
            $table->integer('value')->nullable();
            $table->integer('percent_off')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }

    // {{--<table id="cart" class="table table-hover table-condensed">--}}
    //{{--    <thead>--}}
    //{{--    <tr>--}}
    //{{--        <th style="width:50%">Product</th>--}}
    //{{--        <th style="width:10%">Price</th>--}}
    //{{--        <th style="width:8%">Quantity</th>--}}
    //{{--        <th style="width:22%" class="text-center">Subtotal</th>--}}
    //{{--        <th style="width:10%"></th>--}}
    //{{--    </tr>--}}
    //{{--    </thead>--}}
    //{{--    <tbody>--}}
    //{{--    <?php $total = 0 ?>--}}
    //{{--    @if(session('cart'))--}}
    //{{--        @foreach(session('cart') as $cartId => $cart)--}}
    //{{--            <?php $total += $cart['price'] * $cart['quantity']; ?>--}}
    //{{--            <tr>--}}
    //{{--                <td data-th="Product">--}}
    //{{--                    <div class="row"><div class="col-sm-9">--}}
    //{{--                            <h4 class="nomargin">{{ $cart['name'] }}</h4>--}}
    //{{--                        </div>--}}
    //{{--                    </div>--}}
    //{{--                </td>--}}
    //{{--                <td data-th="Price">${{ $cart['price'] }}</td>--}}
    //{{--                <td data-th="quantity">--}}
    //{{--                    <button wire:click=""type="submit" value="{{$cartId}}" name="decrease"><a href="{{ route('increaseQuantity') }}">Increase</a></button>--}}
    //{{--                    <livewire:counter :cartId="$cartId" :wire:key="$cartId"/>--}}
    //{{--                    <livewire:audio-player :showVideoId="$item['id']" :wire:key="$item['id']" />--}}
    //{{--                    @livewire('counter', {{$cartId}})--}}
    //{{--                    <input type="number" value="{{ $cart['quantity'] }}" class="form-control quantity" />--}}
    //{{--                </td>--}}
    //{{--                <td data-th="Subtotal" class="text-center">${{ $cart['price'] * $cart['quantity'] }}</td>--}}
    //{{--                <td class="actions" data-th="">--}}
    //{{--                    <button class="btn btn-info btn-sm update-cart" data-id="{{ $cartId }}"><i class="fa fa-refresh"></i></button>--}}
    //{{--                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $cartId }}"><i class="fa fa-trash-o"></i></button>--}}
    //{{--                    <button name="add" href="">Add</button>--}}
    //{{--                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $cartId }}"><i class="fa fa-trash-o"></i></button>--}}
    //{{--                </td>--}}
    //{{--            </tr>--}}
    //{{--        @endforeach--}}
    //{{--    @endif--}}
    //{{--    </tbody>--}}
    //{{--    <tfoot>--}}
    //{{--    <tr>--}}
    //{{--        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>--}}
    //{{--        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Go to the cashregister</a></td>--}}
    //{{--        <td colspan="2" class="hidden-xs"></td>--}}
    //{{--        <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td>--}}
    //{{--    </tr>--}}
    //{{--    </tfoot>--}}
    //{{--</table>--}}
    //{{--<h1>Coupon</h1>--}}
    //{{--<input type="text" name="coupone">--}}
    //{{--            </div>--}}
    //{{--        </div>--}}
    //{{--    </div>--}}
};


//            if($discount->discount_type == 'percentage'){
////                $discountPrice=round($total*($discount->percent_off/100));
////                $discountedPrice=($total-$discountPrice);
////                $discountInfo=array(
////                    'discountCode'=>$discountCode,
////                    'discountedPrice'=>$discountedPrice
////                );
//                Session::put('discount', $discountInfo);
