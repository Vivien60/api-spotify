<?php

namespace model\Song\BusinessLogic;

use exception\NotFoundE;
use model\Playlist\BusinessLogic\PlaylistItem;

interface PlaylistStorageInterface
{
    /**
     * @param SongItem $song
     * @return SongItem
     */
    public function fetch(SongItem $song) : SongItem;

    /**
     * @param PlaylistItem $playlist
     * @return array<array{artist:string, title:string, url:string, image:string}>
     * @throws NotFoundE
     */
    public function fetchByPlaylist(PlaylistItem $playlist) : array;
}