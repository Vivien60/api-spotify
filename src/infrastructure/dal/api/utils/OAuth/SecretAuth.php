<?php

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\AuthTypeInterface;

class SecretAuth implements AuthTypeInterface
{
    public mixed $clientId;
    public mixed $clientSecret;

    /**
     * @param mixed $clientId
     * @param mixed $clientSecret
     */
    public function __construct(mixed $clientId, mixed $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }
}