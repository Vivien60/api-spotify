<?php
declare(strict_types=1);

namespace apispotify\infrastructure\repository\playlist\contracts;

use apispotify\infrastructure\repository\contracts\MusicServiceInterface;
use apispotify\model\User\User;
use stdClass;

interface PlaylistServiceInterface extends MusicServiceInterface
{
    public function playlistsFromUser(User $user) : array;

    public function tracksFromUserPlaylist(User $user, int|string $idPlaylist):array;

    public function parsePlaylistItem(StdClass $item): array;
}