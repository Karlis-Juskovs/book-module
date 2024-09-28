<?php

namespace Karlis\Module2;

use Illuminate\Support\ServiceProvider;

class Module2ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the routes, migrations, etc.
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}