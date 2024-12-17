<?php

namespace infrastructure\dal\api\contracts;

interface WithSecretAuthInterface
{
    public function getClientId() : mixed;
    public function getClientSecret() : mixed;
}