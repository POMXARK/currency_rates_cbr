<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Actions\ExchangeRatesAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

/**
 * Текущие курсы валют.
 *
 * @see ExchangeRatesControllerTest
 */
class ExchangeRatesController extends Controller
{
    public function __invoke(ExchangeRatesAction $action): JsonResponse
    {
        $url = config('app.currency_rates_daily_url');

        // Проверка, что URL является строкой
        if (!is_string($url)) {
            return new JsonResponse(['error' => 'Invalid currency rates URL'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response = Http::get($url);

        // Проверка успешности ответа
        if (!$response->successful()) {
            return new JsonResponse(['error' => 'Failed to fetch currency rates'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $data = $action->execute($response->body());

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
