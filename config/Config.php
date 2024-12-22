<?php
namespace config;

use contracts\PlaylistRepoInterface;
use infrastructure\musicService\MusicServiceFactory;
use infrastructure\repository\auth\FileAuthUserRepo;
use infrastructure\repository\AuthUserRepoInterface;
use infrastructure\repository\playlist\PlaylistApiRepo;
use infrastructure\repository\user\UserRepo;

define('TOKEN_STORAGE_FILE', dirname(__FILE__,2).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'token.json');

const API_BASE_URL = 'https://api.spotify.com/v1/';
const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
const CLIENT_ID = '___';
const CLIENT_SECRET = '____';
const REDIRECT_URI = '____';
const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
const CURRENT_SPOTIFY_ACCOUNT = 0;

class Config {
    const API_BASE_URL = 'https://api.spotify.com/v1/';
    const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
    const CLIENT_ID = '___';
    const CLIENT_SECRET = '____';
    const REDIRECT_URI = '____';
    const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
    const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
    const TOKEN_STORAGE_FILE = TOKEN_STORAGE_FILE;
    const CURRENT_SPOTIFY_ACCOUNT = 0;

    private static $instance;
    public UserRepo $userRepo {
        get {
            !empty($this->userRepo)?:new UserRepo();
        }
        set(UserRepo $value) {}
    }
    public PlaylistRepoInterface $playlistRepo {
        get {
            !empty($this->playlistRepo)?:new PlaylistApiRepo();
        }
        set(PlaylistRepoInterface $value) {}
    }
    public AuthUserRepoInterface $authUserRepo {
        get {
            !empty($this->authUserRepo)?:new FileAuthUserRepo();
        }
        set(AuthUserRepoInterface $value) {}
    }

    private function __construct() {
    }

    public static function getInstance(): Config
    {
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }
        return self::$instance;
    }
}