<?php

namespace Karlis\Module2\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Karlis\Module2\database\factories\CurrencyFactory;

class Currency extends Model
{

    protected $table = 'currencies';

    protected $fillable = [
        'usd_rate',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): CurrencyFactory
    {
        return CurrencyFactory::new();
    }
}
