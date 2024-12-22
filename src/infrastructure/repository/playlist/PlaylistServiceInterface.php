<?php

namespace infrastructure\repository\playlist;

use infrastructure\repository\contracts\MusicServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

interface PlaylistServiceInterface extends MusicServiceInterface
{
    public function fromUser(User $user) : ResponseInterface;
}