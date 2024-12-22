<?php

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\internal\WithRefreshTokenInterface;
use infrastructure\dal\api\RequestAbstract;

abstract class RequestWithRefreshTokenAbstract extends RequestAbstract implements WithRefreshTokenInterface
{
    public function __construct(public RefreshToken $token)
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
        return $this->token;
    }
}