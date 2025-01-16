<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

interface WithBearerTokenInterface extends WithTokenInterface
{
    public BearerToken $bearerToken { get; }
}