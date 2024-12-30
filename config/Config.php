<?php
namespace config;

use contracts\PlaylistRepoInterface;
use infrastructure\dal\api\LyricsOvh\client\Client;
use infrastructure\dal\api\musicService\MusicServiceFactory;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\repository\auth\FileAuthUserRepo;
use infrastructure\repository\AuthUserRepoInterface;
use infrastructure\repository\contracts\MusicServiceInterface;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use infrastructure\repository\playlist\PlaylistApiRepo;
use infrastructure\repository\song\contracts\SongServiceInterface;
use infrastructure\repository\user\UserRepo;

define('TOKEN_STORAGE_FILE', dirname(__FILE__,2).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'token.json');

const API_BASE_URL = 'https://api.spotify.com/v1/';
const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
define('CLIENT_ID', getenv("CLIENT_ID"));
define('CLIENT_SECRET', getenv("CLIENT_SECRET"));
const CLIENT_SECRET = '____';
const REDIRECT_URI = '____';
const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
const CURRENT_SPOTIFY_ACCOUNT = 0;

class Config {
    const API_BASE_URL = 'https://api.spotify.com/v1/';
    const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
    const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
    const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
    const TOKEN_STORAGE_FILE = TOKEN_STORAGE_FILE;
    const CURRENT_SPOTIFY_ACCOUNT = 0;
    public static string $CLIENT_ID;
    public static string $CLIENT_SECRET;
    public static string $REDIRECT_URI;

    private static $instance;
    public UserRepo $userRepo {
        get =>  $this->userRepo??=new UserRepo();
        set(UserRepo $value) {}
    }
    public PlaylistRepoInterface $playlistRepo {
        get =>  $this->playlistRepo??=new PlaylistApiRepo();
        set(PlaylistRepoInterface $value) {}
    }
    public AuthUserRepoInterface $authUserRepo {
        get =>  $this->authUserRepo??= new FileAuthUserRepo(self::TOKEN_STORAGE_FILE);
        set(AuthUserRepoInterface $value) {}
    }

    public MusicServiceInterface $musicService {
        get =>  $this->musicService??=MusicServiceFactory::spotify();
        set(MusicServiceInterface $value) {}
    }

    public PlaylistServiceInterface&OAuthInterface $playlistService {
        get => $this->playlistService??=MusicServiceFactory::spotify();
        set(PlaylistServiceInterface $value) {}
    }

    public SongServiceInterface $songService {
        get {
            (!empty($this->songService)?:
                new Client()
            );
        }
        set(SongServiceInterface $value) {}
    }

    private function __construct() {
        self::$CLIENT_ID=getenv("CLIENT_ID");
        self::$CLIENT_SECRET=getenv("CLIENT_SECRET");
        self::$REDIRECT_URI=getenv("REDIRECT_URI");
    }

    public static function getInstance(): Config
    {
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }
        return self::$instance;
    }
}