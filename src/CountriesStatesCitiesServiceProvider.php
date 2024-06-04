<?php

namespace Edeoliv\CountriesStatesCities;

use Edeoliv\CountriesStatesCities\Commands\CountriesStatesCitiesSeederCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CountriesStatesCitiesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        $package
            ->name('laravel-countries-states-cities')
            ->hasConfigFile($this->package->shortName())
            ->hasMigration('create_countries_states_cities_table')
            ->hasCommand(CountriesStatesCitiesSeederCommand::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->publish('models')
                    ->publish('seeders')
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('Edeoliv/laravel-countries-states-cities');
            });
    }

    public function bootingPackage(): void
    {
        parent::bootingPackage();

        if ($this->app->runningInConsole()) {
            // publishes Models And Seeders
            $this->publishes([
                __DIR__.'/../stubs/Models/Country.php.stub' => app_path('Models/Country.php'),
                __DIR__.'/../stubs/Models/State.php.stub' => app_path('Models/State.php'),
                __DIR__.'/../stubs/Models/City.php.stub' => app_path('Models/City.php'),
            ], 'countries-states-cities-models');

            $this->publishes([
                __DIR__.'/../stubs/database/seeders/CountriesStatesCitiesTableSeeder.php.stub' => database_path('seeders/CountriesStatesCitiesTableSeeder.php'),
            ], 'countries-states-cities-seeders');
        }
    }
}
