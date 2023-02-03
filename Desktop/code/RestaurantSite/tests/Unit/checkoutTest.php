<?php

namespace Tests\Unit;

use Laravel\Cashier\Checkout;
use PHPUnit\Framework\TestCase;

class checkoutTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test1()
    {
        $price_rules = [
            'FR1'=>['get_one_free', NULL, NULL],
//'CF1'=>['coffee'],
            'SR1'=>['bulk_discount', 3, '4.50'],
        ];
        $co = new \App\Http\Controllers\Checkout($price_rules);
        $co->scan('FR1');
        $co->scan('FR1');
        $co->scan('FR1');
        $co->scan('SR1');
        $co->scan('CF1');
        $this->assertEquals(22.45, $co->total);
    }
}
