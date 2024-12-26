<?php

namespace infrastructure\dal\api\musicService\contracts;


use infrastructure\dal\api\RequestAbstract;
use infrastructure\entity\TokenItem;

interface RequestFactoryInterface
{
    public function refreshToken(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;

    public function tokenFromCode(mixed $clientId, mixed $clientSecret, TokenItem $token) : RequestAbstract;
}