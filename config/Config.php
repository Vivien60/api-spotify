<?php
namespace config;

use contracts\ApiAuthUserInMemoryRepoInterface;
use contracts\ApiAuthUserRepoInterface;
use contracts\PlaylistRepoInterface;
use contracts\SongRepoInterface;
use infrastructure\dal\api\musicService\MusicServiceFactory;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\repository\auth\ApiAuthUserInMemoryRepo;
use infrastructure\repository\auth\FileApiAuthUserRepo;
use infrastructure\repository\contracts\MusicServiceInterface;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use infrastructure\repository\playlist\PlaylistApiRepo;
use infrastructure\repository\song\contracts\SongServiceInterface;
use infrastructure\repository\song\SongApiRepo;
use infrastructure\repository\user\UserRepo;
use service\contracts\ConfigInterface;

define('TOKEN_STORAGE_FILE', dirname(__FILE__,2).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'token.json');

const API_BASE_URL = 'https://api.spotify.com/v1/';
const TOKEN_BASE_URL = 'https://accounts.spotify.com/';
const SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
const LYRICS_API_BASE_URL = 'https://api.lyrics.ovh/v1/';
const CURRENT_SPOTIFY_ACCOUNT = 0;

class Config implements ConfigInterface {
    private static $instance;
    public string $scope = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';
    public string $CLIENT_ID { get => $this->CLIENT_ID; }
    public string $CLIENT_SECRET { get => $this->CLIENT_SECRET; }
    public string $REDIRECT_URI { get => $this->REDIRECT_URI; }
    public string $lyricsApiBaseUrl = 'https://api.lyrics.ovh/v1/';
    public string $tokenStorageFile = TOKEN_STORAGE_FILE;
    public string $currentSpotifyAccount = '0';
    public UserRepo $userRepo {
        get =>  $this->userRepo??=new UserRepo();
    }
    public SongRepoInterface $songRepo {
        get =>  $this->songRepo??=new SongApiRepo();
    }
    public PlaylistRepoInterface $playlistRepo {
        get =>  $this->playlistRepo??=new PlaylistApiRepo();
    }
    public ApiAuthUserRepoInterface $apiAuthUserRepo {
        get =>  $this->apiAuthUserRepo??= new FileApiAuthUserRepo($this->tokenStorageFile);
    }
    public ApiAuthUserInMemoryRepoInterface $apiAuthUserInMemoryRepo {
        get =>  $this->apiAuthUserInMemoryRepo??= new ApiAuthUserInMemoryRepo();
    }

    public MusicServiceInterface $musicService {
        get =>  $this->musicService??=MusicServiceFactory::spotify();
    }

    public PlaylistServiceInterface&OAuthInterface $playlistService {
        get => $this->playlistService??=MusicServiceFactory::spotify();
    }

    public SongServiceInterface $songService {
        get => $this->songService??=MusicServiceFactory::lyricsOvh();
    }

    private function __construct() {
        $this->CLIENT_ID=getenv("CLIENT_ID");
        $this->CLIENT_SECRET=getenv("CLIENT_SECRET");
        $this->REDIRECT_URI=getenv("REDIRECT_URI");
    }

    public static function getInstance(): Config
    {
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }
        return self::$instance;
    }
}