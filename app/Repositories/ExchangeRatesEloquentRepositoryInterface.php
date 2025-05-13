<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ExchangeRates;

/**
 * Интерфейс репозитория курсов валют.
 */
interface ExchangeRatesEloquentRepositoryInterface
{
    /**
     * Создание модели из массива.
     *
     * @param array<string, mixed> $data
     */
    public function createFromArray(array $data): ExchangeRates;
}
