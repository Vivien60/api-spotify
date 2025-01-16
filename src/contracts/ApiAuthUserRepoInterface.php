<?php
declare(strict_types=1);
namespace contracts;

use infrastructure\entity\TokenItem;
use model\User\User;

interface ApiAuthUserRepoInterface
{
    public function fetchById(?User $user = null): ?TokenItem;
    public function add(TokenItem $token, ?User $user = null): void;
    public function delete(TokenItem $token): void;
}