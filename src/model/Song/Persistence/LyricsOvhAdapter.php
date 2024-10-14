<?php

namespace model\Song\Persistence;

use exception\NotFoundE;
use GuzzleHttp\Exception\GuzzleException;
use model\Song\BusinessLogic\LyricsStorageInterface;
use model\Song\BusinessLogic\SongItem;
use persistenceclient\api\ClientAbstract;
use persistenceclient\api\LyricsOvh\client\Client;
use persistenceclient\api\LyricsOvh\request\Lyrics;
use persistenceclient\api\RequestEndpointInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class LyricsOvhAdapter implements LyricsStorageInterface
{
    private ClientAbstract $api;

    public function __construct() {
        $this->api = new Client();
    }

    /**
     * @param RequestEndpointInterface $request
     * @return ResponseInterface|null
     * @throws Throwable
     */
    protected function fetchWebApi(RequestEndpointInterface $request): ?ResponseInterface
    {
        return $this->api->sendRequest($request);
    }

    /**
     * @throws NotFoundE|GuzzleException
     */
    public function fetch(SongItem $song) : SongItem
    {
        try {
            $response = $this->fetchWebApi(new Lyrics($song->artist, $song->title));
        } catch (NotFoundE $e) {
            throw new NotFoundE();
        }
        $this->hydrateSongWithResponse($song, $response);

        return $song;
    }

    /**
     * @param SongItem $song
     * @param ResponseInterface|null $response
     * @return string|null
     */
    protected function hydrateSongWithResponse(SongItem $song, ?ResponseInterface $response): ?string
    {
        $song->lyrics = is_object($response)?nl2br(json_decode($response->getBody())->lyrics):'';
        return is_object($response)?nl2br(json_decode($response->getBody())->lyrics):null;
    }
}