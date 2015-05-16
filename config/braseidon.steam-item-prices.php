<?php

return [

   /*
    |--------------------------------------------------------------------------
    | Steam API Developer's Key
    |--------------------------------------------------------------------------
    |
    | This is your personal Steam API Developer key. Do not share this!
    | Get it at: http://steamcommunity.com/dev/apikey
    |
    */
    'api_key' => env('STEAM_API_KEY', ''),

   /*
    |--------------------------------------------------------------------------
    | Item Price Cache Time
    |--------------------------------------------------------------------------
    |
    | The number of minutes to cache a single item price for. This
    | prevents your server from being blocked by Steam and also provides a
    | smoother experience for your visitors.
    |
    */
    'cache_time' => env('STEAM_API_CACHE', 120),

];
