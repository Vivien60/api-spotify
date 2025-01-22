<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use apispotify\infrastructure\entity\TokenItem;

interface WithTokenInterface
{
    public TokenItem $token { get; }
}