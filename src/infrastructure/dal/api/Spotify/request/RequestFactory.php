<?php

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\contracts\internal\RequestFactoryInterface;
use infrastructure\entity\TokenItem;

class RequestFactory implements RequestFactoryInterface
{
    public function playlistsMine(TokenItem $token)
    {
        return Playlist::mine($token);
    }

    public function playlistTracks(mixed $clientId, mixed $clientSecret, TokenItem $token)
    {
        return new PlaylistTracks($clientId, $clientSecret, $token);
    }

    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token)
    {
        return new RefreshToken($clientId, $clientSecret, $token);
    }

    public function tokenFromCode(mixed $clientId, mixed $clientSecret, TokenItem $token)
    {
        return new TokenFromCode($clientId, $clientSecret, $token);
    }
}