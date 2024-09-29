<?php

namespace Karlis\Module2\tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestControllerCase extends BaseTestCase
{
    use RefreshDatabase;

    // For easier local module testing orchestra/testbench has been added
    // change BaseTestCase -> OrchestraTestCase
    // uncomment getPackageProviders method
    // and it will be possible to run tests on module1, while it's not attached to a full Laravel project

//    protected function getPackageProviders($app): array
//    {
//        return [
//            \Karlis\Module2\Module2ServiceProvider::class,
//        ];
//    }

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure database migrations are applied
        Artisan::call('migrate');
    }
}
