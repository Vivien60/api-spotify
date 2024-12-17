<?php

namespace infrastructure\repository\playlist;

use infrastructure\repository\ApiRepoAbstract;
use model\Playlist\Playlist as PlaylistItem;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class PlaylistApiRepo extends ApiRepoAbstract
{
    public function __construct()
    {
        parent::__construct();
    }

    public function requestType(): string
    {
        return 'playlist';
    }

    public function findById(int $id): ?PlaylistItem
    {
        return null;
    }

    public function findMyPlaylists(User $user): ?array
    {
        $results = $this->queryWithUserAuth($user);
        return $this->parsePlaylists($results);
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
    protected function hydrateItem(array $playlist): PlaylistItem
    {
        $item = new PlaylistItem();
        $item->id = $playlist['id'];
        $item->title = $playlist['name'];
        $item->url = $playlist['url'];
        $item->imageUrl = $playlist['image'];
        return $item;
    }
}