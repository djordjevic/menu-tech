<?php

namespace Database\Seeders;

use App\Models\BaseCurrency;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $baseCurrency = Currency::query()
            ->where('swift_code', 'USD')
            ->pluck('id');

        BaseCurrency::create(['currency_id' => $baseCurrency[0]]);

    }
}
