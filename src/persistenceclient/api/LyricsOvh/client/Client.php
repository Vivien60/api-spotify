<?php

namespace persistenceclient\api\LyricsOvh\client;

use Exception;
use GuzzleHttp\Exception\RequestException;
use persistenceclient\api\ClientAbstract;

class Client extends ClientAbstract
{

    public const string BASE_URI = 'https://api.lyrics.ovh/v1/';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourne la configuration pour l'instanciation de GuzzleHttp\Client
     * @return string[]
     */
    protected function getConfig(): array
    {
        return ['base_uri' => static::BASE_URI];
    }

    /**
     * @return array<string>
     */
    protected function getHeaders(): array
    {
        return [];
    }

    /**
     * @param RequestException $e
     * @return bool
     */
    protected function isAuthError(RequestException $e): bool
    {
        return false;
    }

    /**
     * @param RequestException|Exception $e
     * @return bool
     */
    protected function isNotFoundError(RequestException|Exception $e): bool
    {
        return $e->getCode() == 404;
    }
}