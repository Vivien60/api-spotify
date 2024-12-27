<?php

namespace infrastructure\dal\api\musicService\contracts;


use infrastructure\dal\api\RequestAbstract;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\entity\TokenItem;

interface OAuthRqFactoryInterface
{
    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;

    public function tokenFromCode(SecretAuth $secret, string $redirectUri, string $code) : RequestAbstract;
}