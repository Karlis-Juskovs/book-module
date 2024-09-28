<?php

namespace Karlis\Module2\database\factories;

use Karlis\Module2\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(255),
            'author_id' => $this->faker->numberBetween(1, 10),
            'release_date' => $this->faker->date('Y-m-d', 'now'),
            'eur_price' => $this->faker->randomFloat(2, 5, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
