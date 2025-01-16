<?php
declare(strict_types=1);

namespace service\contracts;

use contracts\ApiAuthUserInMemoryRepoInterface;
use contracts\ApiAuthUserRepoInterface;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\repository\contracts\MusicServiceInterface;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use infrastructure\repository\song\contracts\SongServiceInterface;
use model\Playlist\PlaylistRepoInterface;
use model\Song\SongRepoInterface;
use model\User\UserRepoInterface;

interface ConfigInterface
{
    public string $scope { get; }
    public string $lyricsApiBaseUrl { get; }
    public string $tokenStorageFile { get; }
    public string $currentSpotifyAccount { get; }
    public string $CLIENT_ID { get; }
    public string $CLIENT_SECRET { get; }
    public string $REDIRECT_URI { get; }
    public UserRepoInterface $userRepo { get; }
    public SongRepoInterface $songRepo { get; }
    public PlaylistRepoInterface $playlistRepo { get; }
    public ApiAuthUserInMemoryRepoInterface $apiAuthUserInMemoryRepo { get; }
    public ApiAuthUserRepoInterface $apiAuthUserRepo { get; }
    public MusicServiceInterface $musicService { get; }
    public PlaylistServiceInterface&OAuthInterface $playlistService { get; }
    public SongServiceInterface $songService { get; }
}