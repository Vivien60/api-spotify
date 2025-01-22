<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\dal\api\AuthTokenAbstract;
use apispotify\infrastructure\entity\TokenItem;

class BearerToken extends AuthTokenAbstract
{
    public static function fromTokenItem(TokenItem $token)
    {
        return new static($token);
    }

    /**
     * Return token string depending on his type
     * Example : token->accessToken
     * @return string
     */
    public function value(): string
    {
        return $this->token->accessToken;
    }
}