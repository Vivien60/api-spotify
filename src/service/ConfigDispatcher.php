<?php

namespace service;

use infrastructure\dal\api\Spotify\request\RequestFactory;
use model\User\Singer;
use service\contracts\ConfigInterface;
use infrastructure\dal\api\musicService\Spotify\Spotify;
use infrastructure\repository\playlist\PlaylistApiRepo;
use infrastructure\repository\song\SongApiRepo;
use model\User\User;

class ConfigDispatcher
{
    private static ?ConfigDispatcher $instance = null;
    
    private function __construct(private ConfigInterface $config)
    {
        Spotify::$config = $config;
        PlaylistApiRepo::$config = $config;
        SongApiRepo::$config = $config;
        GetUserToken::$config = $config;
        GetUserPlaylists::$config = $config;
        User::$config = $config;
        RequestFactory::$config = $config;
        Singer::$config = $config;
        AuthenticatorService::$config = $config;
    }
    
    public static function dispatch(ConfigInterface $config) : void
    {
        if(self::$instance !== null && self::$instance->config !== $config)
        {
            throw new \RuntimeException('Config dispatcher already started with another config');
        }
        self::$instance = new ConfigDispatcher($config);
    }
}