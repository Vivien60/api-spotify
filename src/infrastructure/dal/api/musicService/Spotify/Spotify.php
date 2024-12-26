<?php

namespace infrastructure\dal\api\musicService\Spotify;

use config\Config;
use exception\AuthError;
use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\dal\api\Spotify\utils\UrlForCode;
use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;
use infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use infrastructure\dal\api\musicService\OAuthInterface;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\entity\TokenItem;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class Spotify implements PlaylistServiceInterface, OAuthInterface
{
    private Config $config {
        get {
            $this->config ??= new SecretAuth($this->config::CLIENT_ID, $this->config::CLIENT_SECRET);
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
        private PlaylistRqFactoryInterface $requestFactory,
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

        return  $this->client->sendRequest($request);
    }

    public function songsFromUserPlaylist(User $user, int|string $idPlaylist):ResponseInterface
    {
        $auth = $this->getUserAuth($user);
        $request = $this->requestFactory->playlistTracks($auth, $idPlaylist);

        return  $this->client->sendRequest($request);
    }

    /**
     * @throws \Throwable
     * @throws AuthError
     */
    public function tokenFromCode(string $code): TokenItem
    {
        $request = $this->requestFactory->tokenFromCode($this->appAuth, $this->config::REDIRECT_URI, $code);
        $response = $this->clientOAuth->sendRequest($request);
        $token = json_decode($response->getBody());
        if($token?->access_token) {
            /*
                TODO Vivien :
                    il est implicite ici qu'un seul token est sauvé, car on ne passe pas l'utilisateur associé la méthode add, ce n'est pas correct.
                    Récupérer l'utilisateur courant (puisque le code est renvoyé par le service de musique en appelant une url de notre appli
                    via son navigateur)
            */
            $tokenItem = new TokenItem($token, $token->access_token, $token->refresh_token, true);
            $this->config->authUserRepo->add($tokenItem);
            return $tokenItem;
        } else {
            throw new \exception\AuthError("There was an error while sending token request");
        }
    }

    protected function getUserAuth(User $user): ?\infrastructure\entity\TokenItem
    {
        return $this->config->authUserRepo->fetchById($user);
    }

}