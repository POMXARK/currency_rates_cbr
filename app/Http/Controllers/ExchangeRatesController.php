<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExchangeRatesRequest;
use App\Http\Requests\UpdateExchangeRatesRequest;
use App\Models\ExchangeRates;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Exception\BulkWriteException;
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

        $data = $formatter->toArray();
        foreach ($data as &$els) {
            foreach ($els as &$el) {
                if (is_array($el)) {
                    foreach ($el as $key => $value)
                        if ($key == '@attributes') unset($el[$key]);
                }
            }
        }
        unset($data['@attributes']);
        unset($els, $el);

        ExchangeRates::query()->create($data);



        return response()->json($formatter->toArray());
    }
}
