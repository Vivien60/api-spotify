<?php

namespace infrastructure\musicService\Spotify;

use config\Config;
use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\contracts\internal\ClientForTokenInterface;
use infrastructure\dal\api\contracts\internal\RequestFactoryInterface;
use infrastructure\dal\api\Spotify\utils\UrlForCode;
use infrastructure\musicService\OAuthInterface;
use infrastructure\repository\playlist\PlaylistServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class Spotify implements PlaylistServiceInterface, OAuthInterface
{
    public function __construct(
        private ClientAbstract $client,
        private RequestFactoryInterface $requestFactory,
        private ClientForTokenInterface $clientOAuth,
    )
    {
    }

    public function urlForCode(): UrlForCode
    {
        $config = Config::getInstance();
        return new UrlForCode($this->clientOAuth, $config::CLIENT_ID, $config::REDIRECT_URI);
    }

    public function fromUser(User $user):ResponseInterface
    {
        $authRepo = Config::getInstance()->authUserRepo;
        $auth = $authRepo->fetchById($user);
        $request = $this->requestFactory->playlistsMine($auth);

        return  $this->clientOAuth->sendRequest($request);
    }


}