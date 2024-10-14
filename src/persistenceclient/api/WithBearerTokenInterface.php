<?php

namespace persistenceclient\api;

interface WithBearerTokenInterface
{
    public function getBearerToken() : string;
}