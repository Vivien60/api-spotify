<?php

namespace infrastructure\repository\song\contracts;

use infrastructure\repository\contracts\MusicServiceInterface;
use model\Song\Song as SongItem;
use Psr\Http\Message\ResponseInterface;

interface SongServiceInterface extends MusicServiceInterface
{
    public function songFromSongProp(SongItem $song):ResponseInterface;
}