<?php

namespace App\Http\Controllers\API;

use App\Actions\ExchangeRatesAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

/**
 * Текущие курсы валют.
 *
 * @see ExchangeRatesControllerTest
 */
class ExchangeRatesController extends Controller
{
    public function __invoke(ExchangeRatesAction $action)
    {
        $response = Http::get(config('app.currency_rates_daily_url'));
        $data = $action->execute($response->body());

        return response()->json($data);
    }
}
