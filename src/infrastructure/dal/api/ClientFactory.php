<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api;

use apispotify\infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;
use apispotify\infrastructure\dal\api\LyricsOvh\client\Client as LyricsOvhClient;
use apispotify\infrastructure\dal\api\Spotify\client\Client as SpotifyClient;
use apispotify\infrastructure\dal\api\Spotify\client\ClientForToken;

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