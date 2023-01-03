<?php

namespace App\Http\API\Controllers;

use App\Http\Services\CurrencyService;
use App\Http\Services\ExchangeRateService;


class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    protected $currencyService;
    /**
     * @var ExchangeRateService
     */
    protected $exchangeRateService;

    /**
     * @param CurrencyService $currencyService
     * @param ExchangeRateService $exchangeRateService
     */
    public function __construct(CurrencyService $currencyService, ExchangeRateService $exchangeRateService)
    {
        $this->currencyService = $currencyService;
        $this->exchangeRateService = $exchangeRateService;
    }

    /**
     * @return mixed
     */
    public function getCurrenciesList()
    {
        if(!$this->currencyService->getCachedCurrencies()) {
            return response()->error('No data available through cache and database', '200');
        }

        return response()->success($this->currencyService->getCachedCurrencies(), 'Currencies list', '200');
    }
}
