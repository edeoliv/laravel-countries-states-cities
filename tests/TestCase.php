<?php

namespace Edeoliv\CountriesStatesCities\Tests;

use Edeoliv\CountriesStatesCities\CountriesStatesCitiesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

    }

    protected function getPackageProviders($app): array
    {
        return [
            CountriesStatesCitiesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

    }

    protected function setUpDatabase(): void
    {
        $migration = include __DIR__.'/../database/migrations/create_countries_states_cities_table.php.stub';

        $migration->up();
    }
}
