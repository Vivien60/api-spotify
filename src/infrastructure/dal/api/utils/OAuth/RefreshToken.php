<?php

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\AuthTokenAbstract;
use infrastructure\entity\TokenItem;

class RefreshToken extends AuthTokenAbstract
{
    /**
     * Return token string depending on his type
     * Example : token->accessToken
     * @return string
     */
    public function value(): string
    {
        return $this->token->refreshToken;
    }

    public static function fromTokenItem(TokenItem $token)
    {
        return new static($token);
    }
}