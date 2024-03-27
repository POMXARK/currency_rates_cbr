<?php

namespace Actions;

use App\Actions\ExchangeRatesAction;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

/**
 * Тесты действия для работы с курсами валют.
 *
 * @group ExchangeRatesAction
 * @see ExchangeRatesAction
 */
final class ExchangeRatesActionTest extends TestCase
{
    /**
     * Успешное получения текущего курса валют.
     */
    public function testActionSuccess(): void
    {
        $action = app(ExchangeRatesAction::class);

        $exchangeRates = $action->execute(File::get('./tests/mocks/XML_daily.asp'));

        $this->assertCount(43, $exchangeRates['Valute']);
        $this->assertDatabaseHas('exchange_rates', [
            '_id' => $exchangeRates->id,
        ]);
    }
}
