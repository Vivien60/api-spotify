<?php

namespace model\Song\Persistence;

use exception\NotFoundE;
use model\Credentials\BusinessLogic\TokenItem;
use model\Playlist\BusinessLogic\PlaylistItem;
use model\Song\BusinessLogic\SongItem;
use model\Song\BusinessLogic\PlaylistStorageInterface;
use persistenceclient\api\ClientAbstract;
use persistenceclient\api\RequestEndpointInterface;
use persistenceclient\api\Spotify\client\Client;
use persistenceclient\api\Spotify\request\PlaylistTracks;
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

    /**
     * @param SongItem $song
     * @return SongItem
     */
    public function fetch(SongItem $song): SongItem
    {
        // TODO: Implement fetch() method.
        return $song;
    }

    /**
     * @param PlaylistItem $playlist
     * @return array<array{artist:string, title:string, url:string, image:string}>
     * @throws NotFoundE
     * @throws Throwable
     */
    public function fetchByPlaylist(PlaylistItem $playlist): array
    {
        try {
            $response = $this->fetchWebAPi(new PlaylistTracks($this->token, $playlist->id));
        } catch (NotFoundE $e) {
            throw new NotFoundE();
        }
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
     * @return array<array{artist:string, title:string, url:string, image:string}>
     */
    protected function parseResponse(?ResponseInterface $response): array
    {
        $songs = [];
        foreach ($this->parseItems($response) as $item) {
            $songs = $this->hydrateCollection($this->parseSong($item), $songs);
        }
        return $songs;
    }

    /**
     * @param array{artist: string, title: string, url: string, image: string} $song
     * @param array<array{artist: string, title: string, url: string, image: string}> $songs
     * @return array<array{artist: string, title: string, url: string, image: string}>
     */
    protected function hydrateCollection(array $song, array $songs): array
    {
        if(!in_array($song, $songs)) {
            $songs[] = $song;
        }
        return $songs;
    }

    /**
     * @param stdClass|null $item
     * @return array{artist: string, title: string, url: string, image: string}
     */
    protected function parseSong(?stdClass $item): array
    {
        $song = [];
        $song['artist'] = is_array($item?->track?->artists) ? $item->track->artists[0]?->name : '';
        $song['title'] = $item?->track?->name ?: '';
        $song['url'] = "/lyrics/{$song['title']}+{$song['artist']}";
        $song['image'] = is_array($item?->track?->album?->images) ? $item->track->album->images[0]->url : '';
        return $song;
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
}