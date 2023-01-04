<?php

namespace App\Http\Services;

use App\Http\Repositories\ExchangeRateRepository;
use App\Http\Traits\CommonAppTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ExchangeRateService {

    use CommonAppTrait;

    /**
     * @var ExchangeRateRepository
     */
    protected $exchangeRateRepository;

    /**
     * @param ExchangeRateRepository $exchangeRateRepository
     */
    public function __construct(ExchangeRateRepository $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Insert exchange rates into db from the API
     * @param $data
     * @return void
     */
    public function insertOrUpdateExchangeRates($data):void
    {
        collect($data)
            ->map(function (array $row) {
                return Arr::only($row, ['from_currency', 'to_currency', 'exchange_rate']);
            })
            ->chunk(100)
            ->each(function (Collection $chunk) {
                $this->exchangeRateRepository->insertOrUpdateExchangeRates($chunk->all());
            });
    }

    /**
     * Cache exchange rates
     * @param $data
     * @return void
     */
    public function cacheData($data) : void
    {
        $this->redisInstance()->flushDB();

        foreach ($data as $values) {
            $this->redisInstance()->set($values['to_currency'], $values['exchange_rate']);
        }
    }


}
