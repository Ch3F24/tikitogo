<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
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

Route::get('/',[PageController::class,'home'])->name('home');
Route::get('/dashboard',[ PageController::class,'dashboard'])->middleware(['auth'])->name('dashboard');

//Cart
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/',[CartController::class,'addToCart'])->name('cart.add');
Route::post('/cart',[CartController::class,'remove'])->name('cart.remove.item');
Route::post('/cart/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::get('/checkout/response',[CartController::class,'checkoutResponse'])->name('cart.checkout.response');


Route::get('/order/response',[OrderController::class,'response'])->name('order.response');


//Order
//Route::prefix('order')->group(function () {
//    Route::get('/response',[OrderCo])
//});

//Auth

require __DIR__.'/auth.php';
