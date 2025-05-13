<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ExchangeRates;

/**
 * Репозиторий курсов валют.
 */
class ExchangeRatesEloquentRepository implements ExchangeRatesEloquentRepositoryInterface
{
    /**
     * Создание модели из массива.
     *
     * @param array<string, mixed> $data
     */
    public function createFromArray(array $data): ExchangeRates
    {
        /** @var ExchangeRates $exchangeRate */
        $exchangeRate = ExchangeRates::query()->create($data);

        return $exchangeRate;
    }
}
