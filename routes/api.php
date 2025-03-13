<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\ProductUrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('product', AddProductController::class)->name('add-product');
Route::get('products', ProductUrlController::class)->name('products');
