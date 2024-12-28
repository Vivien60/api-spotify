<?php

namespace infrastructure\dal\api\musicService\Spotify;

use config\Config;
use exception\AuthError;
use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\dal\api\contracts\internal\WithBearerTokenInterface;
use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;
use infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\dal\api\utils\OAuth\BearerToken;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\dal\api\utils\OAuth\UrlForCode;
use infrastructure\entity\TokenItem;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class Spotify implements PlaylistServiceInterface, OAuthInterface
{
    private Config $config {
        get {
            $this->config ??= Config::getInstance();
            return $this->config;
        }
    }
    private SecretAuth $appAuth {
        get {
            $this->appAuth ??= new SecretAuth($this->config::CLIENT_ID, $this->config::CLIENT_SECRET);
            return $this->appAuth;
        }
    }

    public function __construct(
        private ClientAbstract $client,
        private PlaylistRqFactoryInterface & OAuthRqFactoryInterface $requestFactory,
        private ClientForTokenInterface $clientOAuth,
    )
    {
    }

    public function urlForCode(): UrlForCodeAbstract
    {
        $config = $this->config;
        return new UrlForCode($this->clientOAuth, $config::CLIENT_ID, $config::REDIRECT_URI);
    }

    public function playlistFromUser(User $user):ResponseInterface
    {
        $auth = $this->getUserAuth($user);
        $request = $this->requestFactory->playlistsMine($auth);

        return $this->handleRequest($request);
    }

    public function songsFromUserPlaylist(User $user, int|string $idPlaylist):ResponseInterface
    {
        $auth = $this->getUserAuth($user);
        $request = $this->requestFactory->playlistTracks($auth, $idPlaylist);

        return $this->handleRequest($request);
    }

    protected function getUserAuth(User $user): ?\infrastructure\entity\TokenItem
    {
        return $this->config->authUserRepo->fetchById($user);
    }

    /**
     * @throws Throwable
     */
    protected function handleRequest(EndpointRequestInterface $request): ResponseInterface
    {
        try {
            return $this->client->sendRequest($request);
        } catch(AuthError $e) {
            if(is_a($request, WithBearerTokenInterface::class)) {
                $this->refreshToken($request->token);
                return $this->client->sendRequest($request);
            } else {
                throw $e;
            }
        }
    }

    /**
     * @throws Throwable
     */
    protected function refreshToken($token): ResponseInterface
    {
        $request = $this->requestFactory->refreshToken(
            $this->config::CLIENT_ID,
            $this->config::CLIENT_SECRET,
            $token
        );
        return $this->client->sendRequest($request);
    }

    /**
     * @throws Throwable
     * @throws AuthError
     */
    public function tokenFromCode(string $code): TokenItem
    {
        $request = $this->requestFactory->tokenFromCode($this->appAuth, $this->config::REDIRECT_URI, $code);
        $response = $this->clientOAuth->sendRequest($request);
        $token = json_decode($response->getBody());
        if($token?->access_token) {
            return new TokenItem($token, $token->access_token, $token->refresh_token, true);
        } else {
            throw new \exception\AuthError("There was an error while sending token request");
        }
    }

}