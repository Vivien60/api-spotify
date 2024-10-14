<?php

namespace persistenceclient\api\Spotify\client;

use GuzzleHttp\Exception\RequestException;
use persistenceclient\api\ClientAbstract;

class Client extends ClientAbstract
{
    public const string BASE_URI = 'https://api.spotify.com/v1/';

    /**
     * Retourne la configuration pour l'instanciation de GuzzleHttp\Client
     * @return string[]
     */
    protected function getConfig(): array

    {
        return ['base_uri' => static::BASE_URI];
    }

    /**
     * @param RequestException $e
     * @return bool
     */
    protected function isAuthError(RequestException $e): bool
    {
        return $e->getCode() == 401;
    }

    protected function isNotFoundError(RequestException $e): bool
    {
        return $e->getCode() == 404;
    }
}