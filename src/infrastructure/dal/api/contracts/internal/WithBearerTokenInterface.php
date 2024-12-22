<?php

namespace infrastructure\dal\api\contracts\internal;

interface WithBearerTokenInterface
{
    public function getBearerToken() : string;
}