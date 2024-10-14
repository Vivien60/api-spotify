<?php

namespace model\Playlist\Persistense;

use model\Credentials\BusinessLogic\TokenItem;
use model\Playlist\BusinessLogic\PlaylistItem;
use model\Playlist\BusinessLogic\PlaylistStorageInterface;
use persistenceclient\api\ClientAbstract;
use persistenceclient\api\RequestEndpointInterface;
use persistenceclient\api\Spotify\client\Client;
use persistenceclient\api\Spotify\request\Playlist;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Throwable;

class SpotifyAdapter implements PlaylistStorageInterface
{
    private ClientAbstract $apiClient;

    public function __construct(public TokenItem $token)
    {
        $this->apiClient = new Client();
    }

    public function fetch(PlaylistItem $playlist) : PlaylistItem
    {
        return $playlist;
    }

    /**
     * @return array<array{id: string, url: string, image: string, name: string}>
     * @throws Throwable
     */
    public function fetchMine(): array
    {
        $response = $this->fetchWebAPi(Playlist::mine($this->token));
        return $this->parseResponse($response);
    }

    /**
     * @param RequestEndpointInterface $request
     * @return ResponseInterface|null
     * @throws Throwable
     */
    public function fetchWebAPi(
        RequestEndpointInterface $request
    ): ?ResponseInterface
    {
        return $this->apiClient->sendRequest($request);
    }

    /**
     * @param ResponseInterface|null $response
     * @return array<array{id: string, url: string, image: string, name: string}>
     */
    protected function parseResponse(?ResponseInterface $response): array
    {
        $playlists = [];
        foreach ($this->parseItems($response) as $item) {
            $playlists = $this->hydrateCollection($this->parsePlaylist($item), $playlists);
        }
        return $playlists;
    }

    /**
     * @param ResponseInterface|null $response
     * @return array<StdClass>
     */
    protected function parseItems(?ResponseInterface $response): array
    {
        $responseToJson = is_object($response) ? json_decode($response->getBody()) : null;
        return $responseToJson?->items?:[];
    }

    /**
     * @param stdClass $item
     * @return array{id: string, url: string, image: string, name: string}
     */
    protected function parsePlaylist(stdClass $item): array
    {
        return [
            'id' => $item->id,
            'url' => "playlist/{$item->id}",
            'image' => is_array($item->images) ? $item->images[0]->url : '',
            'name' => $item->name,
        ];
    }

    /**
     * @param array{id: string, url: string, image: string, name: string} $playlist
     * @param array<array{id: string, url: string, image: string, name: string}> $playlists
     * @return array<array{id: string, url: string, image: string, name: string}>
     */
    protected function hydrateCollection(array $playlist, array $playlists): array
    {
        if(!in_array($playlist, $playlists)) {
            $playlists[] = $playlist;
        }
        return $playlists;
    }
}