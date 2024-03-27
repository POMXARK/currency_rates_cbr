<?php

namespace Http\API;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

/**
 * Тесты контроллера для работы с курсами валют.
 *
 * @group ExchangeRatesController
 * @see ExchangeRatesController
 */
final class ExchangeRatesControllerTest extends TestCase
{
    /**
     * Ошибка, если запрос выполняется без передачи токена.
     */
    public function testAuthError(): void
    {
        $this->withoutExceptionHandling();
        $this->expectException(HttpException::class);

        $response = $this->get(route('api.currency_rates_daily'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Успешное получения текущего курса валют.
     */
    public function testGetDataSuccess(): void
    {
        $response = $this->withHeader('Authorization', env('MS_TOKEN'))->get(route('api.currency_rates_daily'));

        $response->assertOk();
    }
}
