<?php

use App\Http\Controllers\API\ExchangeRatesController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api'], function () {
    Route::get('currency_rates_daily', ExchangeRatesController::class);
})->middleware(AuthMiddleware::class);
