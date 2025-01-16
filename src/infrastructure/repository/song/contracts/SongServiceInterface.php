<?php
declare(strict_types=1);

namespace apispotify\infrastructure\repository\song\contracts;

use apispotify\infrastructure\repository\contracts\MusicServiceInterface;
use apispotify\model\Song\Song as SongItem;

interface SongServiceInterface extends MusicServiceInterface
{
    public function lyricsFromSongProp(SongItem $song):string;
}