<?php

namespace infrastructure\repository;

use infrastructure\entity\TokenItem;
use model\User\User;

interface AuthUserRepoInterface
{
    public function fetchById(?User $user = null): ?TokenItem;
    public function add(TokenItem $token, ?User $user = null): void;
    public function delete(TokenItem $token): void;
}