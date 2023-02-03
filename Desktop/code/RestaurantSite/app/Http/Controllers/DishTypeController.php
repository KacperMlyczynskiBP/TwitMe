<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishType;
use Illuminate\Http\Request;

class DishTypeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function renderDishType(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        return view('editDishType', compact('dishes', 'dishType'));
    }
}
