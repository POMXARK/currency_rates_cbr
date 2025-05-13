<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ExchangeRates;
use App\Repositories\ExchangeRatesEloquentRepository;
use App\Repositories\ExchangeRatesEloquentRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use SoapBox\Formatter\Formatter;

/**
 * Действие для сохранения текущего курса валют.
 */
final class ExchangeRatesAction
{
    public const SECONDS_IN_DAY = 86400;

    /**
     * Репозиторий курсов валют.
     */
    private ExchangeRatesEloquentRepositoryInterface|ExchangeRatesEloquentRepository $exchangeRatesRepository;

    /**
     * Инициализация.
     */
    public function __construct(ExchangeRatesEloquentRepositoryInterface $exchangeRatesRepository)
    {
        $this->exchangeRatesRepository = $exchangeRatesRepository;
    }

    /**
     * Данные о курсах валют.
     */
    public function execute(string $data): ExchangeRates
    {
        $exchangeRates = Cache::remember('exchange_rates', self::SECONDS_IN_DAY, function () use ($data) {
            sleep(5); // имитация нагрузки на БД

            $formatter = Formatter::make($data, Formatter::XML);
            $formattedData = self::format($formatter->toArray());

            return $this->exchangeRatesRepository->createFromArray($formattedData);
        });

        return $exchangeRates instanceof ExchangeRates ? $exchangeRates : new ExchangeRates();
    }

    /**
     * Форматирование данных.
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    private static function format(array $data): array
    {
        foreach ($data as &$els) {
            if (is_array($els)) {
                foreach ($els as &$el) {
                    if (is_array($el)) {
                        foreach ($el as $key => $value) {
                            if ('@attributes' === $key) {
                                unset($el[$key]);
                            }
                        }
                    }
                }
            }
        }
        unset($data['@attributes']);

        return $data;
    }
}
