<?php
namespace service;

use service\contracts\ConfigInterface;
use contracts\PlaylistRepoInterface;
use contracts\UserRepoInterface;
use model\Playlist\Playlist;
use model\User\User;

class GetUserPlaylists
{
    public static ConfigInterface $config;
    private User $user;
    private PlaylistRepoInterface $playlistRepo;
    private UserRepoInterface $userRepo;

    public function __construct()
    {
        $this->playlistRepo = self::$config->playlistRepo;
        $this->userRepo = self::$config->userRepo;
    }

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
        return $this->userRepo->findCurrentUser();
    }

    /**
     * @param User $user
     * @return array<Playlist>
     */
    public function playlistsByUser(User $user):array
    {
        return $this->playlistRepo->findByUser($user);
    }
    public function byPlaylistIdForCurrentUser(int|string $playlistId): Playlist
    {
        $me = $this->getCurrentUser();
        return $this->playlistRepo->findById($playlistId, $me);
    }
}