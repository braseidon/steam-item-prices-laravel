<?php namespace Braseidon\SteamItemPrices\Support;

use Illuminate\Support\ServiceProvider;

class SteamItemPricesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../../config/braseidon.steam-item-prices.php';
        $this->mergeConfigFrom($configPath, 'braseidon.steam-item-prices');
        $this->publishes([$configPath => config_path('braseidon.steam-item-prices.php')], 'config');

        $this->app->bindShared('braseidon.steam-item-prices', function ($app) {
            return new ItemPrices($app->make('Illuminate\Cache\CacheManager'));
        });

        $this->app->alias('braseidon.steam-item-prices', 'Braseidon\SteamItemPrices\ItemPrices');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['braseidon.steam-item-prices'];
    }
}
