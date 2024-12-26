<?php

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;

class RequestFactory implements PlaylistRqFactoryInterface
{
    public function playlistsMine(TokenItem $token) : Playlist
    {
        return Playlist::mine($token);
    }

    public function playlistTracks(TokenItem $token, string|int $idPlaylist) : PlaylistTracks
    {
        return new PlaylistTracks($token, $idPlaylist);
    }

    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : RefreshToken
    {
        return new RefreshToken($clientId, $clientSecret, $token);
    }

    public function tokenFromCode(mixed $clientId, mixed $clientSecret, TokenItem $token) : TokenFromCode
    {
        return new TokenFromCode($clientId, $clientSecret, $token);
    }
}