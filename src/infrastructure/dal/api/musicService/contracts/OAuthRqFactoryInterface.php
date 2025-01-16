<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService\contracts;


use apispotify\infrastructure\dal\api\RequestAbstract;
use apispotify\infrastructure\dal\api\utils\OAuth\SecretAuth;
use apispotify\infrastructure\dal\api\utils\OAuth\WithSecretAuthInterface;
use apispotify\infrastructure\entity\TokenItem;

interface OAuthRqFactoryInterface
{
    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : WithSecretAuthInterface&RequestAbstract;

    public function tokenFromCode(SecretAuth $secret, string $redirectUri, string $code) : WithSecretAuthInterface&RequestAbstract;
}