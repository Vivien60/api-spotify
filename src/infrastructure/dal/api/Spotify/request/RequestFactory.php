<?php
declare(strict_types=1);

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\entity\TokenItem;
use model\User\User;
use service\contracts\ConfigInterface;

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