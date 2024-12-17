<?php

namespace infrastructure\dal\api;

use infrastructure\dal\api\LyricsOvh\client\Client as LyricsOvhClient;
use infrastructure\dal\api\Spotify\client\Client as SpotifyClient;
use model\Song\Song;

class ClientFactory
{
    public static function default() : ClientAbstract
    {
        return new SpotifyClient();
    }

    public static function fromType(string $type) : ClientAbstract
    {
        switch($type) {
            case 'song':
                return new LyricsOvhClient();
            case 'playlist':
            case 'playlists':
            default:
                return self::default();
        }
    }
}