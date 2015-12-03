<?php namespace Braseidon\SteamItemPrices;

use Config;
use Illuminate\Cache\CacheManager;

class ItemPrices
{

    /**
     * Steam Developer's API key
     *
     * @var integer
     */
    protected $apiKey;

    /**
     * @var CacheManager $cache Caching layer
     */
    protected $cache;

    /**
     * @var array $currencyHtmlTags
     */
    protected $currencyHtmlTags = ['&#36;', '$'];

    /**
     * @param string $cache Instantiate the Object
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;

        $this->apiKey = Config::get('braseidon.steam-item-prices.api_key');
    }

    /**
     * Return the price of an item using Steam's API
     *
     * @param  integer $appId
     * @param  string  $itemName
     * @param  bool    $onlyPrice Return only the lowest price
     * @return stdClass
     */
    public function getPrice($appId, $itemName, $onlyPrice = false)
    {
        $cacheKey = 'steamprice.item.' . str_slug($itemName);

        // Check if item price is cached
        if ($this->cache->has($cacheKey)) {
            $data = $this->cache->get($cacheKey);
        } else {
            // Grab the item price and cache it
            $url = $this->getItemPriceUrl($itemName);

            // No result
            if (! $json = @file_get_contents($url)) {
                // Cache null for 30 seconds to not harass the Steam servers
                $this->cache->put($cacheKey, null, 30);

                return null;
            }

            $json = str_replace($this->currencyHtmlTags, '', $json);
            $data = json_decode($json);

            $this->cache->put($cacheKey, $data, Config::get('braseidon.steam-item-prices.cache_time'));
        }

        if ($onlyPrice === true) {
            $data = (! isset($data->lowest_price)) ? null : $data->lowest_price;
        }

        return $data;
    }

    /**
     * Get the public JSON price for items
     *
     * @param  string $itemName
     * @return stdClass
     */
    protected function getItemPriceUrl($itemName = '', $appId = 730)
    {
        $url = 'https://steamcommunity.com/market/priceoverview/?';

        $data = [
            'appid'            => $appId,
            'currency'         => 1,
            'market_hash_name' => $itemName,
        ];

        return $url . http_build_query($data);
    }

    /**
     * Returns the Steam item SCHEMA json
     *
     * @param  integer $appId
     * @return stdObject
     */
    public function getAppSchema($appId = 730)
    {
        $url = $this->getAppSchemaUrl($appId);
        $json = @file_get_contents($url);

        return json_decode($json);
    }

    /**
     * Pull the item SCHEMA for all Steam items for a specific app
     *
     * @param  integer  $appId
     * @return stdClass
     */
    protected function getAppSchemaUrl($appId = 730)
    {
        $url = 'https://api.steampowered.com/IEconItems_' . $appId . '/GetSchema/v0002/?';

        $data = [
            'language' => 'en',
            'key'      => $this->apiKey,
        ];

        return $url . http_build_query($data);
    }

    /**
     * Item info
     *
     * @param  integer $appId
     * @param  integer $itemId
     * @return stdClass
     */
    public function getItemInfo($appId, $itemId)
    {
        $url = $this->getItemInfoUrl($itemId);
        $json = @file_get_contents($url);

        return json_decode($json);
    }

    /**
     * Returns the URL to query the Steam API
     *
     * @param  integer $appId
     * @param  integer $itemId
     * @return string
     */
    protected function getItemInfoUrl($appId, $itemId)
    {
        $url = 'https://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001/?';

        $data = [
            'key'         => $this->apiKey,
            'format'      => 'json',
            'language'    => 'en',
            'appid'       => $appId,
            'class_count' => 1,
            'classid0'    => $itemId,
        ];

        return $url . http_build_query($data);
    }
}
