<?php

namespace Karlis\Module2\database\factories;

use Karlis\Module2\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition(): array
    {
        return [
            'eur_rate' => $this->faker->randomFloat(2, 0, 3),
            'usd_rate' => $this->faker->randomFloat(2, 0, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
