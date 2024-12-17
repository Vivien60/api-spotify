<?php

namespace infrastructure\dal\api\utils;

use infrastructure\dal\api\contracts\RequestFactoryInterface;
use infrastructure\dal\api\Spotify\request\RequestFactory as SpotifyRequestFactory;

class RequestFactoryProvider
{
    public static function create(): RequestFactoryInterface
    {
        return new SpotifyRequestFactory();
    }
}