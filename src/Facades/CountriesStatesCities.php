<?php

namespace Edeoliv\CountriesStatesCities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Edeoliv\CountriesStatesCities\CountriesStatesCities
 */
class CountriesStatesCities extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Edeoliv\CountriesStatesCities\CountriesStatesCities::class;
    }
}
