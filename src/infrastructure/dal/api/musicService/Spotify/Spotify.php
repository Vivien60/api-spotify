<?php

namespace infrastructure\dal\api\musicService\Spotify;

use config\Config;
use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\dal\api\Spotify\utils\UrlForCode;
use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;
use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class Spotify implements PlaylistServiceInterface, OAuthInterface
{
    public function __construct(
        private ClientAbstract $client,
        private PlaylistRqFactoryInterface $requestFactory,
        private ClientForTokenInterface $clientOAuth,
    )
    {
    }

    public function urlForCode(): UrlForCodeAbstract
    {
        $config = Config::getInstance();
        return new UrlForCode($this->clientOAuth, $config::CLIENT_ID, $config::REDIRECT_URI);
    }

    public function playlistFromUser(User $user):ResponseInterface
    {
        $auth = $this->getUserAuth($user);
        $request = $this->requestFactory->playlistsMine($auth);

        return  $this->client->sendRequest($request);
    }

    public function songFromUserPlaylist(User $user, int|string $idPlaylist):ResponseInterface
    {
        $auth = $this->getUserAuth($user);
        $request = $this->requestFactory->playlistTracks($auth, $idPlaylist);

        return  $this->client->sendRequest($request);
    }

    protected function getUserAuth(User $user): ?\infrastructure\entity\TokenItem
    {
        return Config::getInstance()->authUserRepo->fetchById($user);
    }
}