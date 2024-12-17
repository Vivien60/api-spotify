<?php

namespace infrastructure\dal\api\contracts;

use infrastructure\entity\TokenItem;

interface AuthTokenInterface
{
    public static function fromTokenItem(TokenItem $token);
    public function value() : string|array;
}