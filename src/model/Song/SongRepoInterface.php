<?php
declare(strict_types=1);

namespace apispotify\model\Song;

use apispotify\model\Song\Song as SongItem;

interface SongRepoInterface
{
    /**
     * @param SongItem $songItem
     * @return null|array{title: string, url: string, image: string, artist: string}
     */
    public function findBySongInfo(SongItem $songItem): ?SongItem;
}