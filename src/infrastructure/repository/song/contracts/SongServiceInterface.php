<?php
declare(strict_types=1);

namespace infrastructure\repository\song\contracts;

use infrastructure\repository\contracts\MusicServiceInterface;
use model\Song\Song as SongItem;

interface SongServiceInterface extends MusicServiceInterface
{
    public function lyricsFromSongProp(SongItem $song):string;
}