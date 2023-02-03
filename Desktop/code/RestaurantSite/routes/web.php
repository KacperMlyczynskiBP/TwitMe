<?php

//use App\Http\Controllers\Controller;
//use App\Http\Controllers\Request;
use App\Mail\WelcomeMail;
use App\Http\Controllers\{
    Controller, Request, DishController, DishTypeController,TableController, ReservationController, CartController, loginController,
};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [Controller::class, 'showIndex'])->name('showIndex');

//Route::get('/menu',[Controller::class, 'showMenuSoups'])->name('showMenuSoups');
//Route::get('/adminDashboard', [\App\Http\Controllers\Admin\AdminController::class, 'renderView'])->middleware('isAdmin');


Route::get('/renderLogin',[loginController::class, 'renderLogin'])->name('login');
Route::post('/login', [loginController::class, 'login'])->name('login.user');
Route::get('/renderRegister',[LoginController::class, 'renderRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.user');

Route::get('/editTable', [TableController::class, 'showEditTable'])->name('showEditTable')->middleware(['auth', 'isAdmin']);

Route::middleware(['auth', 'isAdmin'])->group(function(){


      Route::prefix('admin')->group(function(){
        Route::get('/adminDashboard', [\App\Http\Controllers\Admin\AdminController::class, 'renderView']);
//        Route::get('/editTable', [TableController::class, 'showEditTable'])->name('showEditTable');
        Route::get('/createTable', [TableController::class, 'showCreateTable'])->name('showCreateTable');
        Route::post('/createTableOne', [TableController::class, 'createTable'])->name('createTable');
        Route::post('/reserveTable', [ReservationController::class, 'reserveTable'])->name('reserve.table');
        Route::post('/addDish',[DishController::class,'addDish'])->name('addDish');
//        Route::get('/r')
        Route::get('/adminReservation', [ReservationController::class, 'showAdminReservation'])->name('showAdminReservation');
        Route::get('/createDishes', [DishController::class, 'renderAddDish'])->name('renderAddDish');
        Route::get('/editDishType', [DishTypeController::class, 'renderDishType'])->name('renderDishType');
        Route::get('/deleteDish/{id}', [DishController::class, 'deleteDish'])->name('deleteDish');
        Route::get('/addDiscount', [DishController::class, 'renderAddDiscount'])->name('renderAddDiscount');
//        Route::post('/discountApplied', [DishController::class, 'applyDiscount'])->name('applyDiscount');
    });

//    Route::group(['middleware'=>'auth'], function(){
//        Route::group(['middleware'=>'isAdmin', 'prefix'=>'admin'], function(){
//
//        });
    });

Route::prefix('/menu')->controller(Controller::class)->group(function(){
    Route::get('/', 'showIndex')->name('showIndex');
    Route::get('/soups', 'showMenuSoups')->name('showMenuSoups');
    Route::get('/lettuces',  'showMenuSoups')->name('showMenuLettuce');
    Route::get('/desserts',  'showMenuDesserts')->name('showMenuDesserts');
    Route::get('/main',  'showMenuMain')->name('showMenuMain');
    Route::get('/kids', 'showMenuKids')->name('showMenuKids');
    Route::get('/drinks','showMenuColdDrinks')->name('showMenuColdDrinks');
});


Route::get('/socialMedia',[Controller::class, 'socialMedia'])->name('socialMedia');

Route::prefix('/admin')->group(function(){
   Route::get('/addFood',[DishController::class, 'showEditFood'])->name('showEditFood');
});

Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('updateCart',[CartController::class, 'updateCart'])->name('updateCart');
Route::delete('deleteCart',[CartController::class, 'deleteCart'])->name('deleteCart');
Route::get('/cart/increase',[CartController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::post('/cart/coupon', [CartController::class, 'discount'])->name('discount');
Route::get('/cart/coupon/delete',[CartController::class, 'deleteDiscount'])->name('deleteDiscount');


Route::get('/reservation', [ReservationController::class, 'showReservation'])->name('showReservation');


Route::get('/email', function(){
  Mail::to('basill@gmail.com')->send(new WelcomeMail());
  return new WelcomeMail();
});


