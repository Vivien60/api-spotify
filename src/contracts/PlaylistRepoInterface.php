<?php

namespace contracts;

use model\Playlist\Playlist as PlaylistItem;
use model\User\User;

interface PlaylistRepoInterface
{
    public function findById(int $id): ?PlaylistItem;
    public function findByUser(User $user): ?array;

}