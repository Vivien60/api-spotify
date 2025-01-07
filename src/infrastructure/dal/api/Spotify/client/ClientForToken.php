<?php
declare(strict_types=1);

namespace infrastructure\dal\api\Spotify\client;

use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;

class ClientForToken extends Client implements ClientForTokenInterface
{
    public const string SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
    public const string BASE_URI = 'https://accounts.spotify.com/';


    public function getScope() : string
    {
        return static::SCOPE;
    }
}