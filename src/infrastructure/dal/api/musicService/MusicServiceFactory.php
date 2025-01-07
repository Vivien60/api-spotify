<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService;

use infrastructure\dal\api\musicService\LyricsOvh\LyricsOvh;
use infrastructure\dal\api\LyricsOvh\client\Client as LyricsOvhCli;
use infrastructure\dal\api\LyricsOvh\request\RequestFactory as LyricsOvhRequests;
use infrastructure\dal\api\Spotify\client\Client as SpotifyCli;
use infrastructure\dal\api\Spotify\client\ClientForToken;
use infrastructure\dal\api\Spotify\request\RequestFactory as SpotifyRequests;
use infrastructure\dal\api\musicService\Spotify\Spotify;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use infrastructure\repository\song\contracts\SongServiceInterface;

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