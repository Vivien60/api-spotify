<?php
declare(strict_types=1);

namespace apispotify\infrastructure\repository\auth;

use apispotify\contracts\ApiAuthUserInMemoryRepoInterface;
use apispotify\infrastructure\entity\TokenItem;
use apispotify\model\User\User;

class ApiAuthUserInMemoryRepo implements ApiAuthUserInMemoryRepoInterface
{
    public function __construct()
    {
    }

    public function add(TokenItem $token, ?User $user = null): void
    {
        session_regenerate_id();
        $_SESSION['token'] = $token->accessToken;
    }

    public function delete(TokenItem $token): void
    {
        unset($_SESSION['token']);
    }

    public function current(?User $user = null) : ?string
    {
        return $_SESSION['token'] ?? null;
    }
}