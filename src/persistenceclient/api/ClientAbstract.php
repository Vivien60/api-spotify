<?php

namespace persistenceclient\api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class ClientAbstract
{
    protected GuzzleClient $client;

    public const string BASE_URI = 'TO_DEFINE';

    public function __construct()
    {
        $this->initHttpClient();
    }

    /**
     * @return static
     */
    protected function initHttpClient(): static
    {
        $this->client = new GuzzleClient($this->getConfig());
        return $this;
    }

    /**
     * Retourne la configuration pour l'instanciation de GuzzleHttp\Client
     * @return string[]
     */
    abstract protected function getConfig(): array;

    /**
     * @throws Throwable
     */
    public function sendRequest(RequestEndpointInterface $request): ResponseInterface {
        //return $this->client->sendRequest($request);
        try {
            return $this->client->request(
                $request->getMethod(),
                $request->getEndpoint(),
                [
                    'query' => $request->queryParams(),
                    'form_params' => $request->postParams(),
                    'headers' => $request->getHeaders()
                ]
            );
        } catch (GuzzleException $e) {
            throw $request->exception($e);
        }
    }

    abstract protected function isAuthError(RequestException $e): bool;
    abstract protected function isNotFoundError(RequestException $e): bool;
}