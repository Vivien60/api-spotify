<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api;

use apispotify\infrastructure\dal\api\utils\OAuth\AuthTokenInterface;
use apispotify\infrastructure\entity\TokenItem;

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