<?php namespace Braseidon\SteamItemPrices\Support\Facades;

use Illuminate\Support\Facades\Facade;

class SteamItemPrices extends Facade
{

    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor()
    {
        return 'braseidon.steam-item-prices';
    }
}
