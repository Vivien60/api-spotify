<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\Spotify\request;

use apispotify\infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use apispotify\infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use apispotify\infrastructure\dal\api\utils\OAuth\SecretAuth;
use apispotify\infrastructure\entity\TokenItem;
use apispotify\model\User\User;
use apispotify\service\contracts\ConfigInterface;

class RequestFactory implements PlaylistRqFactoryInterface, OauthRqFactoryInterface
{
    public static ConfigInterface $config;

    public function playlistsMine(User $user) : Playlist
    {
        $auth = self::$config->apiAuthUserRepo->fetchById($user);
        return Playlist::mine($auth);
    }

    public function playlistTracks(User $user, string|int $idPlaylist) : PlaylistTracks
    {
        $auth = self::$config->apiAuthUserRepo->fetchById($user);
        return new PlaylistTracks($auth, $idPlaylist);
    }

    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : RefreshToken
    {
        return new RefreshToken(new SecretAuth($clientId, $clientSecret) , $token);
    }

    public function tokenFromCode(SecretAuth $secret, string $redirectUri, string $code) : TokenFromCode
    {
        return new TokenFromCode($secret, $code, $redirectUri);
    }
}