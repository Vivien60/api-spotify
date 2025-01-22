<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\Spotify\request;

use Exception;
use apispotify\exception\RequestAuthError;
use apispotify\infrastructure\dal\api\utils\OAuth\SecretAuth;
use apispotify\infrastructure\dal\api\utils\OAuth\RefreshToken as OAuthRefreshToken;
use apispotify\infrastructure\entity\TokenItem;
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
        return new RequestAuthError("Refresh token failed", $originException);
    }
}