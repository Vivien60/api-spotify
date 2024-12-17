<?php

namespace infrastructure\dal\api\Spotify\request;

use infrastructure\dal\api\utils\OAuth\RequestWithSecretAuthAbstract;
use infrastructure\dal\api\utils\OAuth\SecretAuth;

abstract class TokenRequestAbstract extends RequestWithSecretAuthAbstract
{
    public string $endpoint = "api/token";

    public string $method = "POST";

    public function __construct(SecretAuth $secretAuth)
    {
        parent::__construct($secretAuth);
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