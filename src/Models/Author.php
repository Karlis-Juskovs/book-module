<?php

namespace Karlis\Module2\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Karlis\Module2\database\factories\AuthorFactory;

class Author extends Model
{

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'country',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): AuthorFactory
    {
        return AuthorFactory::new();
    }

    //------------------------------------------------------------------------------------------------------------------
    // Relationships
    //------------------------------------------------------------------------------------------------------------------
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    //------------------------------------------------------------------------------------------------------------------
    // Custom functions
    //------------------------------------------------------------------------------------------------------------------
    public static function test()
    {
        echo "Model 2 test string v.1 \n";
    }
}
