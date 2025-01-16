<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

interface WithSecretAuthInterface
{
    public function getClientId() : mixed;
    public function getClientSecret() : mixed;
}