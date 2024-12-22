<?php

namespace infrastructure\dal\api\contracts\internal;

use Stringable;

interface WithRefreshTokenInterface
{
    public function getRefreshToken() : string|Stringable;
}