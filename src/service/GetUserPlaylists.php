<?php

namespace service;

use config\Config;
use model\Playlist\Playlist;
use model\User\User;

class GetUserPlaylists
{
    private User $user;

    /**
     * @return array<Playlist>
     */
    public function forCurrentUser(): array
    {
        $me = $this->getCurrentUser();
        return $this->playlistsByUser($me);
    }

    private function getCurrentUser(): ?User
    {
        $userRepo = Config::getInstance()->userRepo;
        return $userRepo->findCurrentUser();
    }

    /**
     * @param User $user
     * @return array<Playlist>
     */
    public function playlistsByUser(User $user):array
    {
        $repo = Config::getInstance()->playlistRepo;
        return $repo->findByUser($user);
    }
}