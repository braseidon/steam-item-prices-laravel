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
    protected $currencyHtmlTags = ['&#36;'];

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
     * @param  integer $itemId
     * @return stdClass
     */
    public function getPrice($appId, $itemId)
    {
        // Item info:
        // $url = $this->getItemInfoUrl($appId, $itemId);
        // Item price:
        $url = $this->getItemPriceUrl($itemId);
        $json = @file_get_contents($url);
        $json = str_replace($this->currencyHtmlTags, '', $json);

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

    /**
     * Get the public JSON price for items
     *
     * @param  string $itemName
     * @return stdClass
     */
    protected function getItemPriceUrl($hashName = '', $appId = 730)
    {
        $url = 'https://steamcommunity.com/market/priceoverview/?';

        $data = [
            'appid'            => $appId,
            'currency'         => 1,
            'market_hash_name' => $hashName,
        ];

        return $url . http_build_query($data);
    }
}
