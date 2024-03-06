<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Wallet\WalletTransactionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user/')->controller(UserController::class)->group(function(){
    Route::post('register', 'register');
});

Route::post('transfer', [WalletTransactionsController::class, 'transferFunds']);
