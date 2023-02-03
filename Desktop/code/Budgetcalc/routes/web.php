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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', [\App\Http\Controllers\Controller::class, 'create'])->name('create');
Route::get('/results', [\App\Http\Controllers\Controller::class, 'results'])->name('results');
Route::post('/main/store', [\App\Http\Controllers\Controller::class, 'store'])->name('store');
Route::get('/delete/{id}', [\App\Http\Controllers\Controller::class, 'delete'])->name('delete');
Route::get('/edit/{id}', [\App\Http\Controllers\Controller::class, 'edit'])->name('edit');
