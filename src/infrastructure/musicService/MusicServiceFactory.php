<?php

namespace infrastructure\musicService;

use infrastructure\musicService\Spotify\MusicServiceInterface;
use infrastructure\musicService\Spotify\Spotify;

class MusicServiceFactory
{
    public static function default():MusicServiceInterface
    {
        return new Spotify();
    }
    public static function defaultWithOAuth():MusicServiceInterface&OAuthInterface
    {
        return new Spotify();
    }
}