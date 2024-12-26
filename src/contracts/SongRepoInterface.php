<?php

namespace contracts;

use model\Playlist\Playlist;
use model\Song\Song as SongItem;

interface SongRepoInterface
{
    /**
     * @param SongItem $songItem
     * @return null|array{title: string, url: string, image: string, artist: string}
     */
    public function findBySongInfo(SongItem $songItem): ?array;
}