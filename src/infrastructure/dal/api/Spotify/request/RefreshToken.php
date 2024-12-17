<?php

namespace infrastructure\dal\api\Spotify\request;

use Exception;
use exception\AuthError;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use \infrastructure\dal\api\utils\OAuth\RefreshToken as OAuthRefreshToken;
use infrastructure\entity\TokenItem;
use Throwable;

class RefreshToken extends TokenRequestAbstract
{
    protected OAuthRefreshToken $token;

    public function __construct(SecretAuth $auth, TokenItem $token)
    {
        $this->token = OAuthRefreshToken::fromTokenItem($token);
        parent::__construct($auth);
    }

    public function postParams(): array
    {
        return [
            'refresh_token' => $this->token->value(),
            'grant_type' => 'refresh_token',
            'client_id' => $this->secretAuth->clientId,
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