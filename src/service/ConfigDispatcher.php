<?php
declare(strict_types=1);

namespace apispotify\service;

use apispotify\infrastructure\dal\api\Spotify\request\RequestFactory;
use apispotify\model\User\Singer;
use apispotify\service\contracts\ConfigInterface;
use apispotify\infrastructure\dal\api\musicService\Spotify\Spotify;
use apispotify\infrastructure\repository\playlist\PlaylistApiRepo;
use apispotify\infrastructure\repository\song\SongApiRepo;
use apispotify\model\User\User;

class ConfigDispatcher
{
    private static ?ConfigDispatcher $instance = null;
    
    private function __construct(private ConfigInterface $config)
    {
        Spotify::$config = $config;
        PlaylistApiRepo::$config = $config;
        SongApiRepo::$config = $config;
        GetUserPlaylists::$config = $config;
        User::$config = $config;
        RequestFactory::$config = $config;
        Singer::$config = $config;
        AuthenticatorService::$config = $config;
        OAuthService::$config = $config;
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