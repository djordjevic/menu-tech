<?php
namespace App\Http\Services;

use App\Http\Repositories\CurrencyRepository;
use App\Http\Traits\CommonAppTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CurrencyService {

    use CommonAppTrait;

    /**
     * @var CurrencyRepository
     */
    protected $currencyRepository;
    public $redis;
    public $redisKeys;

    /**
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Check if Redies keys are set
     * @param $values
     * @return bool
     */
    public function redisKeysExist($values) : bool
    {
        foreach ($values as $value) {
            if ($value !== null) {
                return false;
            }
        }
        return true;
    }

    /**
     * Return currencies and exchane rated from the Cache (Redis)
     * @return array
     */
    public function getCachedCurrencies() : array
    {
        $this->redis = $this->redisInstance();
        $this->redisKeys = $this->redis->mget($this->getRequestedCurrencies());

        if($this->redisKeysExist($this->redisKeys)) {
            return $this->getDbCurrencies();
        }

        return ['JPY' => $this->redisKeys[0], 'GBP' => $this->redisKeys[1], 'EUR' => $this->redisKeys[2]];

    }

    /**
     * Return currencies from mysql
     * @return array
     */
    public function getDbCurrencies() : array
    {
        return $this->currencyRepository->getDbCurrencies();
    }

    /**
     * Insert currencies list from the API
     * @param $data
     * @return void
     */
    public function populateCurrenciesList($data) : void
    {
        collect($data)
            ->map(function (array $row) {
                return Arr::only($row, ['swift_code', 'currency_name']);
            })
            ->chunk(100)
            ->each(function (Collection $chunk) {
                $this->currencyRepository->populateCurrenciesList($chunk->all(),'swift_code');
            });
    }

    /**
     * Return base currency from the config if does not exist into db
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getBaseCurrency()
    {
        $dbBaseCurrency = $this->currencyRepository->getBaseCurrency();
        if(empty($dbBaseCurrency)) {
            return $this->getBaseConfigCurrency();
        }

        return $dbBaseCurrency[0];
    }


}
