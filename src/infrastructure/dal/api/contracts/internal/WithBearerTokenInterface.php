<?php
declare(strict_types=1);

namespace infrastructure\dal\api\contracts\internal;

use infrastructure\dal\api\utils\OAuth\BearerToken;

interface WithBearerTokenInterface extends WithTokenInterface
{
    public BearerToken $bearerToken { get; }
}