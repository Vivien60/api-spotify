<?php

namespace persistenceclient\api\Spotify\request;

use persistenceclient\api\RequestWithSecretAuthAbstract;

abstract class TokenRequestAbstract extends RequestWithSecretAuthAbstract
{
    public string $endpoint = "api/token";

    public string $method = "POST";

    public function __construct(mixed $clientId, mixed $clientSecret)
    {
        parent::__construct($clientId, $clientSecret);
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}