<?php

use Illuminate\Support\Facades\Route;

// Register Twill routes here eg.
// Route::module('posts');

//Route::group(['prefix' => 'foods'], function () {
    Route::module('products');
    Route::module('options');
    Route::module('days');
    Route::module('menus');
//});
