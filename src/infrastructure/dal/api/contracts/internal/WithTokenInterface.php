<?php
declare(strict_types=1);

namespace infrastructure\dal\api\contracts\internal;

use infrastructure\entity\TokenItem;

interface WithTokenInterface
{
    public TokenItem $token { get; }
}