<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'swift_code',
        'currency_name',
        'created_at',
        'updated_at'
    ];
}
