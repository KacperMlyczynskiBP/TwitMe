<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Controller, ClientController, ProjectController, TaskController};

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

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [Controller::class, 'create']);

    Route::resource('projects',ProjectController::class)->except('destroy');
    Route::get('/projects/{project}/destroy', [ProjectController::class])->name('projects.destroy');

//    Route::resource('/tasks', TaskController::class)->except('destroy');
//    Route::get('/tasks/{task}/destroy', [TaskController::class])->name('tasks.destroy');

    Route::resource('clients', ClientController::class)->except('destroy','store');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});

