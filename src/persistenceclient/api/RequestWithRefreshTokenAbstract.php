<?php

namespace persistenceclient\api;

use model\Credentials\BusinessLogic\TokenItem;

abstract class RequestWithRefreshTokenAbstract extends RequestAbstract implements WithRefreshTokenInterface
{
    public function __construct(public TokenItem $token)
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->getRefreshToken(),
        ];
    }

    public function getRefreshToken(): string
    {
        return $this->token->refreshToken;
    }
}