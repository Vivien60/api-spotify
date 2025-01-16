<?php
declare(strict_types=1);

namespace model\User;

interface UserRepoInterface
{
    public function findCurrentUser(): ?User;

}