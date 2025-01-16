<?php
declare(strict_types=1);

namespace apispotify\model\Playlist;

use apispotify\model\Playlist\Playlist as PlaylistItem;
use apispotify\model\User\User;

interface PlaylistRepoInterface
{
    public function findById(int|string $id, User $user): ?PlaylistItem;
    public function findByUser(User $user): ?array;

}