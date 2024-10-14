<?php

namespace persistenceclient\api;

use model\Credentials\BusinessLogic\TokenItem;

abstract class RequestWithSecretAuthAbstract extends RequestAbstract implements WithSecretAuthInterface
{
    public function __construct(public mixed $clientId, public mixed $clientSecret)
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
        return $this->clientId;
    }

    public function getClientSecret(): mixed
    {
        return $this->clientSecret;
    }
}