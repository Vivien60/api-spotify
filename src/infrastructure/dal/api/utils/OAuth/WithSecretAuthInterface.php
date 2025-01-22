<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

interface WithSecretAuthInterface
{
    public function getClientId() : mixed;
    public function getClientSecret() : mixed;
}