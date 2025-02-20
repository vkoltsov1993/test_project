<?php

use App\Http\Controllers\ProductUrlController;
use App\Http\Controllers\Subscription\OlxSubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('olx', OlxSubscriptionController::class)->name('olx');
Route::get('products', ProductUrlController::class)->name('products');
