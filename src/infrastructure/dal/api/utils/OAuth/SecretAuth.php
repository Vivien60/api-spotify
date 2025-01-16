<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

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