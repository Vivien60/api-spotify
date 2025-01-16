<?php
declare(strict_types=1);

namespace apispotify\contracts;

use apispotify\infrastructure\entity\TokenItem;
use apispotify\model\User\User;

interface ApiAuthUserInMemoryRepoInterface
{
    public function current(?User $user = null): ?string;
    public function add(TokenItem $token, ?User $user = null): void;
    public function delete(TokenItem $token): void;
}