<?php

use App\Http\Controllers\ExchangeRatesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('currency_rates_daily', ExchangeRatesController::class);
