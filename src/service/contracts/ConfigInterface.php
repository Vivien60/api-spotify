<?php
declare(strict_types=1);

namespace apispotify\service\contracts;

use apispotify\contracts\ApiAuthUserInMemoryRepoInterface;
use apispotify\contracts\ApiAuthUserRepoInterface;
use apispotify\infrastructure\dal\api\musicService\OAuthInterface;
use apispotify\infrastructure\repository\contracts\MusicServiceInterface;
use apispotify\infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use apispotify\infrastructure\repository\song\contracts\SongServiceInterface;
use apispotify\model\Playlist\PlaylistRepoInterface;
use apispotify\model\Song\SongRepoInterface;
use apispotify\model\User\UserRepoInterface;

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