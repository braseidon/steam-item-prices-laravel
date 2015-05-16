<?php namespace Braseidon\SteamItemPrices;

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
     * @param string $cache Instantiate the Object
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
        $this->collection = new Collection();
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
        $url = $this->jsonUrl($appId, $itemId);
        $json = @file_get_contents($url);

        return json_decode(json_encode($json));
    }

    /**
     * Returns the URL to query the Steam API
     *
     * @param  integer $appId
     * @param  integer $itemId
     * @return string
     */
    protected function jsonUrl($appId, $itemId)
    {
        $url = 'http://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001/';

        $data = [
            'key'         => $this->apiKey,
            'format'      => 'json',
            'language'    => 'en',
            'appid'       => $appId,
            'class_count' => 1,
            'classid0'    => $itemId,
        ];

        return $url . '?' . http_build_url($data);
    }
}
