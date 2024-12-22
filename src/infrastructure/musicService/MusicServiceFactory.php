<?php

namespace infrastructure\musicService;

use infrastructure\dal\api\Spotify\client\Client;
use infrastructure\dal\api\Spotify\client\ClientForToken;
use infrastructure\dal\api\Spotify\request\RequestFactory;
use infrastructure\musicService\Spotify\Spotify;
use infrastructure\repository\contracts\MusicServiceInterface;

class MusicServiceFactory
{
    public static function default():MusicServiceInterface
    {
        return new Spotify(
            new Client(),
            new RequestFactory(),
            new ClientForToken(),
        );
    }

    public static function playlistService():MusicServiceInterface
    {
        return new Spotify(
            new Client(),
            new RequestFactory(),
            new ClientForToken(),
        );
    }
}