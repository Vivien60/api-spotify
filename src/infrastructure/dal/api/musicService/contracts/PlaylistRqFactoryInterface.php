<?php

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;
use model\User\User;

interface PlaylistRqFactoryInterface
{
    public function playlistsMine(TokenItem $token) : RequestAbstract;

    public function playlistTracks(TokenItem $token, string|int $idPlaylist) : RequestAbstract;
}