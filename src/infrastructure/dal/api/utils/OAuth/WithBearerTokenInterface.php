<?php
declare(strict_types=1);

namespace infrastructure\dal\api\utils\OAuth;

interface WithBearerTokenInterface extends WithTokenInterface
{
    public BearerToken $bearerToken { get; }
}