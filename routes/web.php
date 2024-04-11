<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    ['prefix' => '/', 'as' => 'restaurant.'],
    function () {
        Route::get('/', [RestaurantController::class, 'stepone'])->name('stepone');
        Route::post('/ajax', [RestaurantController::class, 'ajax'])->name('ajax');
        Route::get('/submit', [RestaurantController::class, 'submit'])->name('submit');
    }
);