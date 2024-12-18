<?php

namespace infrastructure\repository;

use infrastructure\entity\TokenItem;
use model\User\User;

interface AuthUserRepoInterface
{
    public function fetchById(?User $user = null): ?TokenItem;
    public function add(mixed $token): void;
    public function delete(mixed $token): void;
}