<?php namespace Braseidon\SteamItemPrices;

class ItemPrices
{

    /**
     * Steam Developer's API key
     *
     * @var integer
     */
    protected $apiKey;

    public function getPrice($appId, $itemId)
    {
        $json = file_get_contents($this->jsonUrl($appId, $itemId));

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
        $url = 'http://api.steampowered.com/ISteamEconomy/GetAssetClassInfo/v0001?';

        $data = [
            'key'         => $this->apiKey,
            'format'      => 'json',
            'language'    => 'en',
            'appid'       => $appId,
            'class_count' => 1,
            'classid0'    => $itemId,
        ];

        return $url . http_build_url($data);
    }
}
