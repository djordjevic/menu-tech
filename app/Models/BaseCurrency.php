<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'created_at',
        'updated_at'
    ];

    public function relatedCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
