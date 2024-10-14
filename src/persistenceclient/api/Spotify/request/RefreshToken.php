<?php

namespace persistenceclient\api\Spotify\request;

use Exception,Throwable;
use exception\AuthError;
use model\Credentials\BusinessLogic\TokenItem;

class RefreshToken extends TokenRequestAbstract
{
    public function __construct(mixed $clientId, mixed $clientSecret, public TokenItem $token)
    {
        parent::__construct($clientId, $clientSecret);
    }
    public function postParams(): array
    {
        return [
            'refresh_token' => $this->token->refreshToken,
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
        ];
    }

    public function queryParams(): array
    {
        return [];
    }

    public function exception(Exception|Throwable $originException): Throwable
    {
        return new AuthError("Refresh token failed", $originException);
    }
}