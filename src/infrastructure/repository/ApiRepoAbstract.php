<?php

namespace infrastructure\repository;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\repository\contracts\MusicServiceInterface;
use Psr\Http\Message\ResponseInterface;

abstract class ApiRepoAbstract
{
    protected ClientAbstract $client;
    protected MusicServiceInterface $musicService;

    public function __construct()
    {
    }

    protected function parseQResponse(ResponseInterface $results): array
    {
        $items = [];
        foreach ($results as $playlist) {
            $items[] = $this->hydrateItem($playlist);
        }
        return $items;
    }

    abstract protected function hydrateItem(array $item): Object;

}