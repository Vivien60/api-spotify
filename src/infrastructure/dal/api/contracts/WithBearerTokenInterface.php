<?php

namespace infrastructure\dal\api\contracts;

interface WithBearerTokenInterface
{
    public function getBearerToken() : string;
}