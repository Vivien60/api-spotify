<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService;

use apispotify\infrastructure\dal\api\musicService\LyricsOvh\LyricsOvh;
use apispotify\infrastructure\dal\api\LyricsOvh\client\Client as LyricsOvhCli;
use apispotify\infrastructure\dal\api\LyricsOvh\request\RequestFactory as LyricsOvhRequests;
use apispotify\infrastructure\dal\api\Spotify\client\Client as SpotifyCli;
use apispotify\infrastructure\dal\api\Spotify\client\ClientForToken;
use apispotify\infrastructure\dal\api\Spotify\request\RequestFactory as SpotifyRequests;
use apispotify\infrastructure\dal\api\musicService\Spotify\Spotify;
use apispotify\infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use apispotify\infrastructure\repository\song\contracts\SongServiceInterface;

class MusicServiceFactory
{
    public static function spotify():PlaylistServiceInterface&OAuthInterface
    {
        return new Spotify(
            new SpotifyCli(),
            new SpotifyRequests(),
            new ClientForToken(),
        );
    }

    public static function lyricsOvh():SongServiceInterface
    {
        return new LyricsOvh(
            new LyricsOvhCli(),
            new LyricsOvhRequests(),
        );
    }
}