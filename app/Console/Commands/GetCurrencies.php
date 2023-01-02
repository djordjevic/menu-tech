<?php

namespace App\Console\Commands;

use App\Http\Services\CurrencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencylayer:getcurrencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyService $currencyService)
    {
        $res = Http::get( env('CURRENCY_LAYER_CURRENCIES'), [
            'Content-Type' => 'text/plain',
            'apikey' => env('CURRENCY_API_KEY'),
        ]);

        if($res->ok()) {
            foreach($res['currencies'] as $key=>$value) {
                $data[] = [
                    'swift_code' => $key,
                    'currency_name' => $value,
                ];
            }

            $currencyService->populateCurrenciesList($data);
//            $currencyService->cacheData($data);
        }
        logger("ERROR FETCHING CURRENCIES LIST -", [$res->body()]);

        return [];    }
}
