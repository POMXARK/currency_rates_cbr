<?php

namespace App\Repositories;

use App\Models\ExchangeRates;

/**
 * Репозиторий курсов валют.
 */
class ExchangeRatesEloquentRepository implements ExchangeRatesEloquentRepositoryInterface
{
    /**
     * Создание модели из массива.
     */
    public function createFromArray(array $data): ExchangeRates
    {
        /** @var ExchangeRates */
        return ExchangeRates::query()
            ->create($data);
    }
}
