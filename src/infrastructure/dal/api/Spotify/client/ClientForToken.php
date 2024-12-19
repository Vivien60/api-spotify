<?php

namespace infrastructure\dal\api\Spotify\client;

class ClientForToken extends Client implements ClientForTokenInterface
{
    public const string BASE_URI = 'https://accounts.spotify.com/';
}