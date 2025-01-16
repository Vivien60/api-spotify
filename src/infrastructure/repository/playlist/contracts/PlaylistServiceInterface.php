<?php
declare(strict_types=1);

namespace infrastructure\repository\playlist\contracts;

use infrastructure\repository\contracts\MusicServiceInterface;
use model\User\User;
use stdClass;

interface PlaylistServiceInterface extends MusicServiceInterface
{
    public function playlistsFromUser(User $user) : array;

    public function tracksFromUserPlaylist(User $user, int|string $idPlaylist):array;

    public function parsePlaylistItem(StdClass $item): array;
}