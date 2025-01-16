<?php
declare(strict_types=1);

namespace apispotify\model\Playlist;

class PlaylistList
{
    /**
     * @var Playlist[]
     */
    public array $playlists = [];
    public mixed $idSpotify = CURRENT_SPOTIFY_ACCOUNT;

    public function __construct($idSpotify = CURRENT_SPOTIFY_ACCOUNT)
    {
        $this->idSpotify = $idSpotify;
    }
}