<?php

namespace App\Http\Controllers;

use App\Actions\ExchangeRatesAction;

class ExchangeRatesController extends Controller
{
    /**
     * Текущие курсы валют.
     */
    public function __invoke(ExchangeRatesAction $action)
    {
        $data = $action->execute(config('app.currency_rates_daily_url'));

        return response()->json($data);
    }
}
