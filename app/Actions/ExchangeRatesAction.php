<?php

namespace App\Actions;

use App\Models\ExchangeRates;
use App\Repositories\ExchangeRatesEloquentRepository;
use App\Repositories\ExchangeRatesEloquentRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use SoapBox\Formatter\Formatter;

/**
 * Действие для сохранения текущего курса валют.
 */
final class ExchangeRatesAction
{
    const SECONDS = 10;

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
        $this->exchangeRatesRepository = $exchangeRatesRepository;
    }

    /**
     * Данные о курсах валют.
     */
    public function execute(string $url): ExchangeRates
    {
        return Cache::remember('exchange_rates', self::SECONDS , function () use ($url) {
            sleep(5); // имитация нагрузки на БД

            $response = Http::get($url);
            $formatter = Formatter::make($response->body(), Formatter::XML);
            $data = $formatter->toArray();

            return $this->exchangeRatesRepository->createFromArray(self::format($data));
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
