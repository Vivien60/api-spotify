<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\utils\OAuth;

use Stringable;

interface WithRefreshTokenInterface extends WithTokenInterface
{
    public function getRefreshToken() : string|Stringable;
}