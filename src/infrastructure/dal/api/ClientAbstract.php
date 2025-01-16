<?php
declare(strict_types=1);

namespace infrastructure\dal\api;

use exception\RequestAuthError;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use infrastructure\dal\api\musicService\contracts\OAuthRqFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class ClientAbstract
{
    protected GuzzleClient $client;
    protected OAuthRqFactoryInterface $requestFactory;

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

    abstract public function getBaseUri(): string;

    /**
     * @throws Throwable
     */
    public function sendRequest(EndpointRequestInterface $request): ResponseInterface {
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
            if($this->isAuthError($e)) throw new RequestAuthError($e->getMessage(), $e);
            throw $request->exception($e);
        }
    }

    abstract protected function isAuthError(Throwable $e): bool;
    abstract protected function isNotFoundError(Throwable $e): bool;
}