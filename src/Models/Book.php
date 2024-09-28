<?php

namespace Karlis\Module2\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Karlis\Module2\database\factories\BookFactory;

class Book extends Model
{

    protected $fillable = [
        'title',
        'description',
        'author',
        'release_date',
        'eur_price',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): BookFactory
    {
        return BookFactory::new();
    }
}
