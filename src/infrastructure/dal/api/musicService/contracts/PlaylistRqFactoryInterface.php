<?php

namespace infrastructure\dal\api\musicService\contracts;

use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use infrastructure\dal\api\contracts\internal\WithBearerTokenInterface;
use infrastructure\entity\TokenItem;

interface PlaylistRqFactoryInterface
{
    public function playlistsMine(TokenItem $token) : EndpointRequestInterface & WithBearerTokenInterface;

    public function playlistTracks(TokenItem $token, string|int $idPlaylist) : EndpointRequestInterface & WithBearerTokenInterface;
}