<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;
use App\Models\Dish;
use App\Models\DishType;
use Illuminate\Http\Request;


class DishController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function renderAddDish()
    {
        $dishes = Dish::all();
        $dishType = DishType::all();
        return view('createDishes', compact('dishes', 'dishType'));
    }

    public function showEditFood()
    {
        $dishes = Dish::all();
        $dishType = DishType::all();
        return view('editFood', compact('dishes', 'dishType'));
    }

    public function addDish(DishRequest $request)
    {
        $input = $request->all();
        $name = $request->dish_id;
        $dishType = DishType::where('name', $name)->get()->first();
        $input['dish_id'] = $dishType->id;
        $dish = new Dish($input);
        $dish->save();
        $dishType->dishes()->save($dish);
    }

    public function deleteDish($id)
    {
        $dish=Dish::find($id);

        if(!$dish){
            return redirect()->route('');
        }
        $dish->delete();
    }
}
