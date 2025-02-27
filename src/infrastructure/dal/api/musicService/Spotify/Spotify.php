<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService\Spotify;

use apispotify\exception\RequestAuthError;
use apispotify\infrastructure\dal\api\ClientAbstract;
use apispotify\infrastructure\dal\api\contracts\EndpointRequestInterface;
use apispotify\infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;
use apispotify\infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use apispotify\infrastructure\dal\api\musicService\contracts\PlaylistRqFactoryInterface;
use apispotify\infrastructure\dal\api\musicService\OAuthInterface;
use apispotify\infrastructure\dal\api\utils\OAuth\SecretAuth;
use apispotify\infrastructure\dal\api\utils\OAuth\UrlForCode;
use apispotify\infrastructure\dal\api\utils\OAuth\WithBearerTokenInterface;
use apispotify\infrastructure\entity\TokenItem;
use apispotify\infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use apispotify\model\User\User;
use Psr\Http\Message\ResponseInterface;
use Random\RandomException;
use apispotify\service\contracts\ConfigInterface;
use stdClass;
use Throwable;

class Spotify implements PlaylistServiceInterface, OAuthInterface
{
    public static ConfigInterface $config;
    private SecretAuth $appAuth {
        get {
            $this->appAuth ??= new SecretAuth(self::$config->CLIENT_ID, self::$config->CLIENT_SECRET);
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

    /**
     * @throws RandomException
     */
    public function urlForCode(): UrlForCode
    {
        $config = self::$config;
        return new UrlForCode($this->clientOAuth, $config->CLIENT_ID, $config->REDIRECT_URI);
    }

    /**
     * @throws Throwable
     */
    public function playlistsFromUser(User $user, $retry = true):array
    {
        $request = $this->requestFactory->playlistsMine($user);
        $response = $this->handleRequestWithRefresh($request, $user);
        $parsedResponse = $this->parseResponse($response);
        return $this->parseForPlaylists($parsedResponse->items);
    }

    /**
     * @throws Throwable
     */
    public function tracksFromUserPlaylist(User $user, int|string $idPlaylist):array
    {
        $request = $this->requestFactory->playlistTracks($user, $idPlaylist);
        $response = $this->handleRequestWithRefresh($request, $user);
        $parsedResponse = $this->parseResponse($response);
        return $this->parseForTracks($parsedResponse->items);
    }

    /**
     * @throws Throwable
     * @throws RequestAuthError
     */
    public function tokenFromCode(string $code): TokenItem
    {
        $request = $this->requestFactory->tokenFromCode($this->appAuth, self::$config->REDIRECT_URI, $code);
        $response = $this->clientOAuth->sendRequest($request);
        $token = json_decode($response->getBody()->getContents());
        if($token?->access_token) {
            return new TokenItem($token, $token->access_token, $token->refresh_token, true);
        } else {
            throw new \apispotify\exception\RequestAuthError("There was an error while sending token request");
        }
    }

    /**
     * @throws Throwable
     */
    private function handleRequestWithRefresh(
        EndpointRequestInterface&WithBearerTokenInterface $request,
        User $user
    ): ResponseInterface {
        try {
            return $this->handleRequest($request);
        } catch (RequestAuthError $e) {
            return $this->refreshTokenThenRetry($request, $user, __METHOD__);
        }
    }

    /**
     * @throws Throwable
     */
    protected function handleRequest(EndpointRequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }

    /**
     * @throws Throwable
     */
    private function refreshTokenThenRetry(
        EndpointRequestInterface&WithBearerTokenInterface $request,
        User $user,
        string $methodName
    ) {
        $this->refreshToken($request, $user);
        return call_user_func_array([$this, $methodName], [$user, false]);
    }


    /**
     * @throws RequestAuthError
     * @throws Throwable
     */
    protected function refreshToken(EndpointRequestInterface $request, User $user): TokenItem
    {
        if(is_a($request, WithBearerTokenInterface::class)) {
            $refreshRequest = $this->requestFactory->refreshToken(
                self::$config->CLIENT_ID,
                self::$config->CLIENT_SECRET,
                $request->token
            );
            $response = $this->handleOAuthRequest($refreshRequest);
            return $this->saveNewTokenFromResponse($response, $user, $request->token);
        }
        throw new \apispotify\exception\RequestAuthError("There was an error while refreshing token");
    }

    /**
     * @throws Throwable
     */
    protected function handleOAuthRequest(EndpointRequestInterface $request): ResponseInterface
    {
        return $this->clientOAuth->sendRequest($request);
    }

    /**
     * @throws RequestAuthError
     */
    public function saveNewTokenFromResponse(ResponseInterface $response, User $user, TokenItem $oldToken): TokenItem
    {
        $token = json_decode($response->getBody()->getContents());
        if ($token?->access_token) {
            $oldToken->accessToken = $token->access_token;
            $newToken = new TokenItem($token, $oldToken->accessToken, $oldToken->refreshToken, true);
            self::$config->apiAuthUserRepo->add($newToken);
            return $newToken;
        }
        throw new \apispotify\exception\RequestAuthError("There was an error while refreshing token");
    }

    public function parseResponse(ResponseInterface $response): ?StdClass
    {
        return json_decode($response->getBody()->getContents());
    }

    private function parseForPlaylists(array $items) : array
    {
        $playlists = [];
        foreach($items as $item)
        {
            $playlists[] = $this->parsePlaylistItem($item);
        }
        return $playlists;
    }

    public function parsePlaylistItem(StdClass $item): array
    {
        return [
            'id' => $item->id,
            'url' => "playlist/{$item->id}",
            'image' => is_array($item->images) ? $item->images[0]->url : '',
            'name' => $item->name,
        ];
    }

    private function parseForTracks(array $items) : array
    {
        $tracks = [];
        foreach($items as $item)
        {
            $tracks[] = $this->parseTrackItem($item);
        }
        return $tracks;
    }

    public function parseTrackItem(StdClass $item): array
    {
        $song = [];
        $song['artist'] = is_array($item?->track?->artists) ? $item->track->artists[0]?->name : '';
        $song['title'] = $item?->track?->name ?: '';
        $song['url'] = "/lyrics/{$song['title']}+{$song['artist']}";
        $song['image'] = is_array($item?->track?->album?->images) ? $item->track->album->images[0]->url : '';
        return $song;
    }
}