<?php

namespace infrastructure\repository;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\repository\contracts\MusicServiceInterface;
use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class ApiRepoAbstract
{
    protected ClientAbstract $client;
    protected MusicServiceInterface $musicService;

    public function __construct()
    {
    }

    protected function parseQResponse(ResponseInterface $response): array
    {
        $items = [];
        foreach ($this->parseResponseItems($response) as $playlist) {
            $items[] = $this->hydrateItem($playlist);
        }
        return $items;
    }

    protected function parseResponseItems(ResponseInterface $response): \Iterator
    {
        $jsonResponse = json_decode($response->getBody()->getContents());
        foreach ($jsonResponse->items as $item) {
            yield $this->parseItem($item);
        }
    }

    abstract protected function hydrateItem(array $item): Object;

    abstract protected function parseItem(StdClass $item): array;

}