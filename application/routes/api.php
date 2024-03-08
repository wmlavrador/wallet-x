<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Wallet\WalletTransactionsController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->controller(UserController::class)->group(function(){
    Route::post('register', 'register')
        ->name('user.register');

    Route::post('login', 'authenticate')
        ->name('user.authenticate');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('wallet')->controller(WalletTransactionsController::class)->group(function(){
        Route::post('new-transaction', 'newTransaction')
            ->name('wallet.new-transaction');
    });

    Route::prefix('user')->controller(UserController::class)->group(function(){
        Route::get('profile', 'index')
            ->name('user.profile');
    });
});
