<?php

namespace infrastructure\repository\playlist\contracts;

use infrastructure\repository\contracts\MusicServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

interface PlaylistServiceInterface extends MusicServiceInterface
{
    public function playlistFromUser(User $user) : ResponseInterface;

    public function songFromUserPlaylist(User $user, int|string $idPlaylist):ResponseInterface;
}