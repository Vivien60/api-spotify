<?php

namespace infrastructure\repository\user;

use model\User\User;
use Psr\Http\Message\ResponseInterface;

class UserRepo
{
    public function __construct()
    {
        parent::__construct();
    }

    public function requestType(): string
    {
        return 'playlist';
    }

    public function findById(int $id): ?User
    {
        //$this->requestFactory->playlistTracks()->fetch($playlist);
        return null;
    }

    public function findCurrentUser(): ?User
    {
        return new User();
    }

    protected function parsePlaylists(ResponseInterface $results): array
    {
        $items = [];
        foreach ($results as $playlist) {
            $items[] = $this->hydrateItem($playlist);
        }
        return $items;
    }

    /**
     * @param array{id: string, url: string, image: string, name: string} $playlist
     * @return PlaylistItem
     */
    protected function hydrateItem(array $playlist): User
    {

    }
}