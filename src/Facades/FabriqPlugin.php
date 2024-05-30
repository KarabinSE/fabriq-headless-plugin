<?php

namespace Karabin\FabriqPlugin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Karabin\FabriqPlugin\FabriqPlugin
 */
class FabriqPlugin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Karabin\FabriqPlugin\FabriqPlugin::class;
    }
}
