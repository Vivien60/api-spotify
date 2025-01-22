<?php
declare(strict_types=1);

namespace apispotify\infrastructure\repository\user;

use apispotify\model\User\User;
use apispotify\model\User\UserRepoInterface;
use Psr\Http\Message\ResponseInterface;

class UserRepo implements UserRepoInterface
{
    public function __construct()
    {
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

    protected function hydrateItem(array $playlist): User
    {

    }
}