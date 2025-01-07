<?php
declare(strict_types=1);

namespace infrastructure\repository\playlist;

use model\Playlist\BusinessLogic\PlaylistItem;

class PlaylistRepo
{
    public PlaylistStorageInterface $storage;

    /**
     * @param PlaylistStorageInterface $storage
     */
    public function __construct(PlaylistStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function retrievePlaylist(PlaylistItem $playlist) : void
    {
        //$this->storage->fetch($playlist);
    }

    /**
     * @return array<PlaylistItem>
     */
    public function getAllMyPlaylists() : array
    {
        $items = [];
        foreach($this->storage->fetchMine() as $playlist) {
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