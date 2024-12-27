<?php

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\entity\TokenItem;

class RequestFactory implements PlaylistRqFactoryInterface, OauthRqFactoryInterface
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

    public function tokenFromCode(SecretAuth $secret, string $redirectUri, string $code) : TokenFromCode
    {
        return new TokenFromCode($secret, $code, $redirectUri);
    }
}