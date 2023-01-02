<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'foreign_currency',
        'exchange_rate',
        'surcharge_percent',
        'surcharge_amount',
        'foreign_currency_amount',
        'total_paid_amount',
        'discount_percent',
        'discount_amount',
        'created_at',
        'updated_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relatedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeWithEmailAndCurrency($query)
    {
        $query->addSelect(['email' => User::select('email')
            ->whereColumn('user_id', 'users.id')
            ->latest()
            ->take(1)
        ])
            ->addSelect(['swift_code' => Currency::select('swift_code')
                ->whereColumn('foreign_currency', 'currencies.id')
                ->latest()
                ->take(1)
            ]);
    }

}
