<?php

namespace infrastructure\repository;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\repository\contracts\MusicServiceInterface;

abstract class ApiRepoAbstract
{
    protected ClientAbstract $client;

    public function __construct(protected MusicServiceInterface $musicService)
    {
    }
}