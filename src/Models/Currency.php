<?php

namespace Karlis\Module2\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Karlis\Module2\database\factories\CurrencyFactory;

class Currency extends Model
{

    protected $table = 'currencies';

    protected $fillable = [
        'eur_rate',
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

    //------------------------------------------------------------------------------------------------------------------
    // Custom functions
    //------------------------------------------------------------------------------------------------------------------
    public static function convertValue(string $from, string $to, float $amount): float
    {
        $currency = self::orderBy('created_at', 'desc')->first();

        if (!$currency) {
            throw new \Exception('Currency rates not found.');
        }

        if ($from === 'eur' && $to === 'usd') {
            $conversionRate = $currency->usd_rate;
        } elseif ($from === 'usd' && $to === 'eur') {
            if ($currency->usd_rate !== 0) {
                $conversionRate = 1 / $currency->usd_rate;
            } else {
                throw new \Exception('Falsy USD rate found in currency conversion rates.');
            }
        } elseif ($from === $to) {
            return $amount;
        } else {
            throw new \Exception('Invalid currency conversion.');
        }

        return round($amount * $conversionRate, 2);
    }
}
