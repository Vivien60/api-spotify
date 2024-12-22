<?php

namespace infrastructure\dal\api\contracts\internal;

interface WithSecretAuthInterface
{
    public function getClientId() : mixed;
    public function getClientSecret() : mixed;
}