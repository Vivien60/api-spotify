<?php

namespace infrastructure\repository\contracts;

use Psr\Http\Message\ResponseInterface;
use stdClass;

interface MusicServiceInterface
{
    public function parseResponse(ResponseInterface $response): ?StdClass;
}