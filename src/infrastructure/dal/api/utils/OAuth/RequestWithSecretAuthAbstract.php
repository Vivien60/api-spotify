<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\dal\api\contracts\internal\WithSecretAuthInterface;
use infrastructure\dal\api\RequestAbstract;

abstract class RequestWithSecretAuthAbstract extends RequestAbstract implements WithSecretAuthInterface
{
    public function __construct(public SecretAuth $secretAuth)
    {
        parent::__construct();
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode($this->getClientId() . ':' . $this->getClientSecret()),
        ];
    }

    public function getClientId(): mixed
    {
        return $this->secretAuth->clientId;
    }

    public function getClientSecret(): mixed
    {
        return $this->secretAuth->clientSecret;
    }
}