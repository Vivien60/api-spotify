<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

use infrastructure\entity\TokenItem;

interface WithTokenInterface
{
    public TokenItem $token { get; }
}