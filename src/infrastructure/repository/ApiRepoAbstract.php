<?php
declare(strict_types=1);

namespace apispotify\infrastructure\repository;

use apispotify\infrastructure\dal\api\ClientAbstract;
use apispotify\infrastructure\repository\contracts\MusicServiceInterface;
use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class ApiRepoAbstract
{
    protected ClientAbstract $client;
    protected MusicServiceInterface $musicService;

    public function __construct()
    {
    }

    /*protected function parseQResponse(ResponseInterface $response): array
    {
        $items = [];
        foreach ($this->parseResponseItems($response) as $playlist) {
            $items[] = $this->hydrateItem($playlist);
        }
        return $items;
    }

    protected function parseResponseItems(ResponseInterface $response): \Iterator
    {
        $items = $this->musicService->parseResponse($response);
        foreach ($items as $item) {
            yield $this->parseItem($item);
        }
    }*/

}