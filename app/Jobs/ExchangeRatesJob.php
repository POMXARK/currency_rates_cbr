<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\ExchangeRatesAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

/**
 * Текущие курсы валют.
 *
 * @see ExchangeRatesJobTest
 */
class ExchangeRatesJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(ExchangeRatesAction $action): void
    {
        $url = config('app.currency_rates_daily_url');

        // Проверка, что URL является строкой
        if (!is_string($url)) {
            // Обработка ошибки, если URL не является строкой
            return;
        }

        $response = Http::get($url);
        $action->execute($response->body());
    }
}
