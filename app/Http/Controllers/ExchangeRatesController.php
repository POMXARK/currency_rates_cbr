<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExchangeRatesRequest;
use App\Http\Requests\UpdateExchangeRatesRequest;
use App\Models\ExchangeRates;
use Illuminate\Support\Facades\Http;
use SoapBox\Formatter\Formatter;

class ExchangeRatesController extends Controller
{
    /**
     * Текущие курсы валют.
     */
    public function __invoke()
    {
        $response = Http::get('http://www.cbr.ru/scripts/XML_daily.asp');
        $formatter = Formatter::make($response->body(), Formatter::XML);

        return response()->json($formatter->toArray());
    }
}
