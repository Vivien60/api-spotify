<?php

namespace service;

use infrastructure\repository\playlist\PlaylistRepoFactory;
use infrastructure\repository\user\UserRepo;
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

    private function getCurrentUser(): User
    {
        $userRepo = new UserRepo();
        return $userRepo->findCurrentUser();
    }

    /**
     * @param User $user
     * @return array<Playlist>
     */
    public function playlistsByUser(User $user):array
    {
        $repo = PlaylistRepoFactory::createDefault();
        return $repo->findMyPlaylists($user);
    }
}