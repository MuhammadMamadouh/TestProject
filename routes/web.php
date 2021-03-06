<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TruckController;
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
    return redirect()->route('trucks.index');
});

Route::resource('trucks', TruckController::class);

Route::resource('orders', OrderController::class);

Route::get('getTrucks/{id}', 'App\Http\Controllers\AjaxController@getTrucks')->name('getTrucks');
