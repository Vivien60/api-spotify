<?php

namespace persistenceclient\api;

use model\Credentials\BusinessLogic\TokenItem;

abstract class RequestWithBearerTokenAbstract extends RequestAbstract implements WithBearerTokenInterface, RequestEndpointInterface
{
    public function __construct(public TokenItem $token)
    {
        parent::__construct();
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
        ];
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBearerToken(): string
    {
        return $this->token->accessToken;
    }
}