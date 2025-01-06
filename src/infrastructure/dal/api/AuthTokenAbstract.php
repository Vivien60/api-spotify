<?php

namespace infrastructure\dal\api;

use infrastructure\dal\api\contracts\internal\AuthTokenInterface;
use infrastructure\entity\TokenItem;

abstract class AuthTokenAbstract implements AuthTokenInterface, \Stringable
{

    public function __construct(protected TokenItem $token)
    {

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * Return token string depending on his type
     * Example : token->accessToken
     * @return string|string[]
     */
    abstract public function value() : string|array;
}