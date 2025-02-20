<?php

use App\Http\Controllers\VerifyUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', VerifyUserController::class)->name('verification.verify');
