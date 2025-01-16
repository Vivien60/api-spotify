<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\dal\api\AuthTokenAbstract;
use apispotify\infrastructure\entity\TokenItem;

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