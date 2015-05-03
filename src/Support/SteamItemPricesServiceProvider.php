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
        $configPath = __DIR__ . '/../../config/braseidon.steamitemprices.php';
        $this->mergeConfigFrom($configPath, 'braseidon.steamitemprices');
        $this->publishes([$configPath => config_path('braseidon.steamitemprices.php')], 'config');

        $this->app->bindShared('braseidon.steamitemprices', function ($app) {
            return new ItemPrices($app->make('Illuminate\Cache\CacheManager'));
        });

        $this->app->alias('braseidon.steamitemprices', 'Braseidon\SteamItemPrices\ItemPrices');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['braseidon.steamitemprices'];
    }
}
