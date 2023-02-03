<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishType extends Model
{
    use HasFactory;

    protected $fillable=['name'];


    public function dishes(){
        return $this->hasMany('App\Models\Dish', 'dish_id');
    }
}
