<?php

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
    const SECONDS_IN_DAY = 86400;

    /**
     * Репозиторий курсов валют.
     *
     * @var ExchangeRatesEloquentRepository|ExchangeRatesEloquentRepositoryInterface
     */
    private ExchangeRatesEloquentRepositoryInterface|ExchangeRatesEloquentRepository $exchangeRatesRepository;

    /**
     * Инициализация.
     */
    public function __construct(ExchangeRatesEloquentRepositoryInterface $exchangeRatesRepository)
    {
        //Cache::forget('exchange_rates');
        $this->exchangeRatesRepository = $exchangeRatesRepository;
    }

    /**
     * Данные о курсах валют.
     */
    public function execute(string $data): ExchangeRates
    {
        return Cache::remember('exchange_rates', self::SECONDS_IN_DAY , function () use ($data) {
            sleep(5); // имитация нагрузки на БД

            Cache::forget('exchange_rates');
            $formatter = Formatter::make($data, Formatter::XML);

            return $this->exchangeRatesRepository->createFromArray(self::format($formatter->toArray()));
        });
    }

    /**
     * Форматирование данных.
     */
    static private function format(array $data): array
    {
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

        return $data;
    }
}
