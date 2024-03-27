<?php

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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(ExchangeRatesAction $action): void
    {
        $response = Http::get(config('app.currency_rates_daily_url'));
        $action->execute($response->body());;
    }
}
