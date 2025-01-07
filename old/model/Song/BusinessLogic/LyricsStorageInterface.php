<?php
declare(strict_types=1);

namespace model\Song\BusinessLogic;

use exception\NotFoundE;
use GuzzleHttp\Exception\RequestException;

interface LyricsStorageInterface
{
    /**
     * @param SongItem $song
     * @return SongItem
     * @throws NotFoundE
     */
    public function fetch(SongItem $song) : SongItem;
}