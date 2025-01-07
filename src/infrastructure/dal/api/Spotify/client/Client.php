<?php
declare(strict_types=1);

namespace infrastructure\dal\api\Spotify\client;

use GuzzleHttp\Exception\RequestException;
use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\Spotify\request\RequestFactory;
use Throwable;

class Client extends ClientAbstract
{
    public const string BASE_URI = 'https://api.spotify.com/v1/';

    public function __construct()
    {
        $this->requestFactory = new RequestFactory();
        parent::__construct();
    }

    /**
     * Retourne la configuration pour l'instanciation de GuzzleHttp\Client
     * @return string[]
     */
    protected function getConfig(): array

    {
        return ['base_uri' => $this->getBaseUri()];
    }

    /**
     * @param RequestException $e
     * @return bool
     */
    protected function isAuthError(Throwable $e): bool
    {
        return $e->getCode() == 401;
    }

    protected function isNotFoundError(Throwable $e): bool
    {
        return $e->getCode() == 404;
    }

    public function getBaseUri(): string
    {
        return static::BASE_URI;
    }
}