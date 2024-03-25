<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ExchangeRates extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'exchange_rates';

    protected $guarded = [];
}
