<?php

namespace infrastructure\dal\api;

use infrastructure\dal\api\contracts\AuthTokenInterface;
use infrastructure\dal\api\contracts\AuthTypeInterface;
use infrastructure\entity\TokenItem;

abstract class AuthTokenAbstract implements AuthTypeInterface, AuthTokenInterface, \Stringable
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