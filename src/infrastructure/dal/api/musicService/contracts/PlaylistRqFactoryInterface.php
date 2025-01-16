<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService\contracts;

use apispotify\infrastructure\dal\api\contracts\EndpointRequestInterface;
use apispotify\model\User\User;

interface PlaylistRqFactoryInterface
{
    public function playlistsMine(User $user) : EndpointRequestInterface;

    public function playlistTracks(User $user, string|int $idPlaylist) : EndpointRequestInterface;
}