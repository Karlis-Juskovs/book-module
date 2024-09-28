<?php

namespace Karlis\Module2\database\factories;

use Karlis\Module2\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'date_of_birth' => $this->faker->date('Y-m-d', 'now'),
            'country' => $this->faker->country,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
