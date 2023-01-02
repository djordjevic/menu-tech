<?php
namespace App\Http\Services;

use App\Http\Repositories\CurrencyRepository;
use App\Http\Traits\CommonAppTrait;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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
     * @return array
     */
    public function getDbCurrencies() : array
    {
        return $this->currencyRepository->getDbCurrencies();
    }

    /**
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


}
