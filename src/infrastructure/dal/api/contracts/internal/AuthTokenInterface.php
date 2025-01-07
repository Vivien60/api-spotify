<?php
declare(strict_types=1);

namespace infrastructure\dal\api\contracts\internal;

use infrastructure\entity\TokenItem;

interface AuthTokenInterface extends AuthTypeInterface
{
    public static function fromTokenItem(TokenItem $token);
    public function value() : string|array;
}