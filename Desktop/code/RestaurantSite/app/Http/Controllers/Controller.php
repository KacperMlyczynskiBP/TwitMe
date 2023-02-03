<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DishType;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Session;
use Share;
use Carbon\Carbon;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function setValue($value){
         return $this->value=$value;
     }
   public function map_array(int $a, string $b): array
    {
        return [$a => $b];
    }

//    public function map(){
////        showMenuSoups);
////        showMenuLettuce
////        showMenuDesserts
////        showMenuMain
////        showMenuKids
////        showMenuColdDrinks
////    }

    public function showMenuSoups(){

//        dd($c);
        $socialShare=Share::page('http://jorenvanhocht.be', 'Share title')
            ->facebook()
            ->twitter()
            ->getRawLinks();
        $dishes=Dish::all();
        $dishType=DishType::all();
        $soup=DishType::where('id', 1)->get()->first();
        $soupId=$soup->id;
        return view('menu', compact('dishes','dishType', 'soupId', 'socialShare'));
    }

    public function showIndex(){
       $socialShare=Share::page('http://jorenvanhocht.be', 'name')->facebook();
       return view('index', compact('socialShare'));
    }


    public function showMenuLettuces(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        $lettuce=DishType::where('id', 2)->get()->first();
        $lettuceId=$lettuce->id;
        return view('menu', compact('dishes','dishType', 'lettuceId'));
    }

    public function showMenuDesserts(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        $dessert=DishType::where('id', 3)->get()->first();
        $dessertId=$dessert->id;
        return view('menu', compact('dishes','dishType', 'dessertId'));
    }

    public function showMenuMain(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        $main=DishType::where('id', 4)->get()->first();
        $mainId=$main->id;
        return view('menu', compact('dishes','dishType', 'mainId'));
    }

    public function showMenuKids(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        $kids=DishType::where('id', 5)->get()->first();
        $kidsId=$kids->id;
        return view('menu', compact('dishes','dishType', 'kidsId'));
    }

    public function showMenuColdDrinks(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        $drink=DishType::where('id', 6)->get()->first();
        $drinkId=$drink->id;
        return view('menu', compact('dishes','dishType', 'drinkId'));
    }


    public function renderAddDish(){
        $dishes=Dish::all();
        $dishType=DishType::all();
        return view('createDishes', compact('dishes','dishType'));
    }


//    public function renderLogin(){
////         return view('login');
//        dd('s');
//    }
//
//    public function login(Request $request){
//           $input=$request->all();
//           $email=$input['email'];
//            $user=User::where('email', $email)->get()->first();
//             if($user){
//                 Session::put('user', $user->email);
//                return redirect()->route('showEditTable');
//        }
////                return redirect()->route('showIndex')->with('error', 'Wrong credentials');
//           }

//    public function addDish(Request $request){
//        $input=$request->all();
//         $name=$request->dish_id;
//        $dishType=DishType::where('name', $name)->get()->first();
//        $input['dish_id'] = $dishType->id;
//        $dish = new Dish($input);
//        $dish->save();
//        $dishType->dishes()->save($dish);
//    }


}


//<form method="POST" action="{{ route('add.to.cart') }}">
//    @csrf
//@foreach($dishes->where('dish_id', $soupId) as $dish)
//  <div class="dish" style="">
//    <div>{{$dish->name}}</div><br/>
//    <div class="weight">{{$dish->weight}}</div><br/>
//    <div>{{$dish->body}}</div>
//{{--     <a href="{{ route('add.to.cart') }}" class="button">Buy Me--}}
//{{--     </a>--}}
//      <input type="hidden" name="product_id" value="{{$dish->id}}">
//      <button type="submit" name="submit">{{$dish->price}}</button>
//{{--      <a href="{{ route('add.to.cart') }}">{{$dish->price}}</a>--}}
//      {{--      <input type="submit" name="submit">--}}
//  </div>                      <br/>
//
//@endforeach
//    </form>
