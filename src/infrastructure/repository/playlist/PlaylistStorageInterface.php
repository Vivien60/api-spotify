<?php

namespace infrastructure\repository\playlist;

use model\Playlist\BusinessLogic\PlaylistItem;

interface PlaylistStorageInterface
{
    /**
     * @param PlaylistItem $playlist
     * @return PlaylistItem
     */
    public function fetch(PlaylistItem $playlist) : PlaylistItem;

    /**
     * @return array<array{id: string, url: string, image: string, name: string}>
     */
    public function fetchMine(): array;
}