<?php

namespace persistenceclient\api\Spotify\request;

use exception\NotFoundE, Throwable;

class TokenFromCode extends TokenRequestAbstract
{
    public function __construct(string $clientId, string $clientSecret, public readonly string $code, public readonly string $redirectUri)
    {
        parent::__construct($clientId, $clientSecret);
    }

    /**
     * @return string[]
     */
    public function postParams(): array
    {
        return [
            'code' => $this->code,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code'
        ];
    }

    public function queryParams(): array
    {
        return [];
    }

    public function exception(Throwable $originException) : Throwable
    {
        return new NotFoundE(
            "Problème détecté avec l'association : " . $originException->getMessage()
        );
    }
}