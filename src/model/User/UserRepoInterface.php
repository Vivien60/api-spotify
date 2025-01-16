<?php
declare(strict_types=1);

namespace apispotify\model\User;

interface UserRepoInterface
{
    public function findCurrentUser(): ?User;

}