<?php

namespace model\Playlist\BusinessLogic;

use model\Song\BusinessLogic\SongItem as SongItem;

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