<?php

namespace infrastructure\dal\api\contracts\internal;

use Stringable;

interface WithRefreshTokenInterface extends WithTokenInterface
{
    public function getRefreshToken() : string|Stringable;
}