<?php

namespace Jobs;

use App\Jobs\ExchangeRatesJob;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

/**
 * Тесты заданий для работы с курсами валют.
 *
 * @group ExchangeRatesJob
 * @see ExchangeRatesJob
 */
class ExchangeRatesJobTest  extends TestCase
{
    /**
     * Успешное выполнение задания.
     */
    public function testJobSuccess(): void
    {
        Queue::fake();

        ExchangeRatesJob::dispatch();

        Queue::assertPushed(ExchangeRatesJob::class);
    }
}
