<?php

namespace infrastructure\musicService\Spotify;

use infrastructure\dal\api\Spotify\client\ClientForToken;
use infrastructure\dal\api\Spotify\utils\UrlForCode;
use infrastructure\musicService\OAuthInterface;

class Spotify implements MusicServiceInterface, OAuthInterface
{
    public function urlForCode(): UrlForCode
    {
        $client = new ClientForToken();
        return new UrlForCode($client,CLIENT_ID, REDIRECT_URI);
    }
}