<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use model\User\User;

interface PlaylistRqFactoryInterface
{
    public function playlistsMine(User $user) : EndpointRequestInterface;

    public function playlistTracks(User $user, string|int $idPlaylist) : EndpointRequestInterface;
}