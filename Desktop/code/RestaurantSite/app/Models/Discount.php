<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class Discount extends Model
{
    use HasFactory;
   public $total;


    public function applyDiscount($total):int{
           if($this->discount_type == 'percentage'){
               return round($total*($this->percent_off/100));
           } elseif($this->discount_type == 'fixed'){
               return $this->value;
           } else{
               return 0;
           }
    }
}
