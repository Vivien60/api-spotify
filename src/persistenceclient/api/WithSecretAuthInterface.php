<?php

namespace persistenceclient\api;

interface WithSecretAuthInterface
{
    public function getClientId() : mixed;
    public function getClientSecret() : mixed;
}