<?php

namespace App\Console\Commands;

use App\Http\Services\CurrencyService;
use App\Http\Services\ExchangeRateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 *
 */
class GetCurrencyExchangeRatesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencylayer:get_exchange_rates_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all currencies from the API and fulfill the MySql and Redis db\'s';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ExchangeRateService $exchangeRateService, CurrencyService $currencyService)
    {

        $baseCurrency = $currencyService->getBaseCurrency();

        $res = Http::get( env('CURRENCY_LAYER_EXCHANGE_RATES'), [
            'Content-Type' => 'text/plain',
            'apikey' => env('CURRENCY_API_KEY'),
            'source' => $baseCurrency,
        ]);

        if($res->ok()) {
            foreach($res['quotes'] as $key=>$value) {
                $data[] = [
                    'from_currency' => $baseCurrency,
                    'to_currency' => substr($key, 3),
                    'exchange_rate' => $value
                ];
            }

            $exchangeRateService->insertOrUpdateExchangeRates($data);
            $exchangeRateService->cacheData($data);
        }
        logger("ERROR FETCHING CURRENCY API -", [$res->body()]);

        return [];
    }

}
