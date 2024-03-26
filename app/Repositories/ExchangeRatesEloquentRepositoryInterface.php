<?php

namespace App\Repositories;

use App\Models\ExchangeRates;

/**
 * Интерфейс репозитория курсов валют.
 */
interface ExchangeRatesEloquentRepositoryInterface
{
    /**
     * Создание модели из массива.
     */
    public function createFromArray(array $data): ExchangeRates;
}
