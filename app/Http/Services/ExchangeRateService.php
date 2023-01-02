<?php

namespace App\Http\Services;

use App\Http\Repositories\ExchangeRateRepository;
use App\Http\Traits\CommonAppTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

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
     * @return array
     */
    public function getBaseCurrency() : array
    {
        return $this->exchangeRateRepository->getBaseCurrency();
    }

    /**
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
