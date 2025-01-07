<?php
declare(strict_types=1);

namespace contracts;

use model\Playlist\Playlist as PlaylistItem;
use model\User\User;

interface UserRepoInterface
{
    public function findCurrentUser(): ?User;

}