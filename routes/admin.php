<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

// Register Twill routes here eg.
// Route::module('posts');

//Route::group(['prefix' => 'foods'], function () {
    Route::module('products');
    Route::module('options');
    Route::module('days');
    Route::module('menus');
    Route::module('orders');
//});
Route::get('report', [OrderController::class,'report'])->name('ordersReport');
Route::get('orders/{id}/editing',[OrderController::class,'editing'])->name('admin.order.editing');
