<?php

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\internal\EndpointRequestInterface;
use infrastructure\dal\api\contracts\internal\WithBearerTokenInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;

abstract class RequestWithBearerTokenAbstract extends RequestAbstract implements WithBearerTokenInterface, EndpointRequestInterface
{
    protected BearerToken $token;

    public function __construct(TokenItem $token)
    {
        $this->token = BearerToken::fromTokenItem($token);
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
        ];
        parent::__construct();
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
        return $this->token;
    }
}