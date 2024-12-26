<?php

namespace infrastructure\dal\api\musicService;

use infrastructure\dal\api\Spotify\client\Client;
use infrastructure\dal\api\Spotify\client\ClientForToken;
use infrastructure\dal\api\Spotify\request\RequestFactory;
use infrastructure\dal\api\musicService\Spotify\Spotify;
use infrastructure\repository\contracts\MusicServiceInterface;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use infrastructure\repository\song\contracts\SongServiceInterface;

class MusicServiceFactory
{
    public static function default():MusicServiceInterface
    {
        return static::spotify();
    }

    public static function playlistService():PlaylistServiceInterface
    {
        return static::spotify();
    }

    public static function spotify():PlaylistServiceInterface
    {
        return new Spotify(
            new Client(),
            new RequestFactory(),
            new ClientForToken(),
        );
    }

    public static function lyricsOvh():SongServiceInterface
    {
        return new Client();
    }
}