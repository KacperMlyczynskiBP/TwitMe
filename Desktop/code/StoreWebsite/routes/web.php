<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [\App\Http\Controllers\Controller::class, 'index']);
Route::get('/singleItem', [\App\Http\Controllers\Controller::class, 'create']);






Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);


Route::resource('/admin/products', \App\Http\Controllers\AdminProductController::class)->except('show');


Route::resource('/admin/categories', \App\Http\Controllers\AdminCategoryController::class)->except('show');

//Route::get('/admin/products', [\App\Http\Controllers\AdminProductController::class, 'index']);
//Route::get('/admin/product/create', [\App\Http\Controllers\AdminProductController::class, 'create']);
//Route::post('/admin/product/store', [\App\Http\Controllers\AdminProductController::class, 'store']);
//Route::get('/admin/product/delete', [\App\Http\Controllers\AdminProductController::class, 'delete']);
//Route::get('/admin/product/edit', [\App\Http\Controllers\AdminProductController::class, 'edit']);
//Route::post('/admin/product/update', [\App\Http\Controllers\AdminProductController::class, 'update']);
