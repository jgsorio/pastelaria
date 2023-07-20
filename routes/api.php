<?php

use App\Http\Controllers\{
    ClientController,
    OrderController,
    ProductController
};
use Illuminate\Support\Facades\Route;

Route::resource('clients', ClientController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);