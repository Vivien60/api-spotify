<?php

namespace contracts;

use infrastructure\entity\TokenItem;
use model\User\User;

interface ApiAuthUserInMemoryRepoInterface
{
    public function current(?User $user = null): ?string;
    public function add(TokenItem $token, ?User $user = null): void;
    public function delete(TokenItem $token): void;
}