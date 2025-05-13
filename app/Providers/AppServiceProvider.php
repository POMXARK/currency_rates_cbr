<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\ExchangeRatesEloquentRepository;
use App\Repositories\ExchangeRatesEloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ExchangeRatesEloquentRepositoryInterface::class,
            ExchangeRatesEloquentRepository::class);
    }
}
