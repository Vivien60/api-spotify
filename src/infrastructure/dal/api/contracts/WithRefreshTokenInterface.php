<?php

namespace infrastructure\dal\api\contracts;

use Stringable;

interface WithRefreshTokenInterface
{
    public function getRefreshToken() : string|Stringable;
}