<?php

use App\Http\Controllers\API\ExchangeRatesController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('currency_rates_daily', ExchangeRatesController::class);
});
