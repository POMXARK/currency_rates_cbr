<?php

declare(strict_types=1);

use App\Jobs\ExchangeRatesJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new ExchangeRatesJob())
    ->skip(function () {
        return Cache::get('exchange_rates');
    })
    ->daily()
    ->withoutOverlapping();
