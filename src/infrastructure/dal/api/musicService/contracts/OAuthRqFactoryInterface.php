<?php
declare(strict_types=1);

namespace infrastructure\dal\api\musicService\contracts;


use infrastructure\dal\api\contracts\internal\WithSecretAuthInterface;
use infrastructure\dal\api\RequestAbstract;
use infrastructure\dal\api\utils\OAuth\SecretAuth;
use infrastructure\entity\TokenItem;

interface OAuthRqFactoryInterface
{
    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : WithSecretAuthInterface&RequestAbstract;

    public function tokenFromCode(SecretAuth $secret, string $redirectUri, string $code) : WithSecretAuthInterface&RequestAbstract;
}