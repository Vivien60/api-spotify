<?php

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;
use model\User\User;

interface PlaylistRqFactoryInterface extends RequestFactoryInterface
{
    public function playlistsMine(User $token) : RequestAbstract;

    public function playlistTracks(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;
}