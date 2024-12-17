<?php

namespace model\Song\BusinessLogic;

use exception\NotFoundE;
use model\Playlist\BusinessLogic\PlaylistItem;

class SongRepo
{
    /**
     * @param LyricsStorageInterface|null $lyricsStorage
     * @param PlaylistStorageInterface $storage
     */
    public function __construct(public ?LyricsStorageInterface $lyricsStorage, public ?PlaylistStorageInterface $storage)
    {
    }

    /**
     * @return array<array{artist:string, title:string, url:string, image:string}>
     * @throws NotFoundE
     */
    public function songsByPlaylist(PlaylistItem $playlist) : array
    {
        $itemColl = [];
        foreach ($this->storage?->fetchByPlaylist($playlist) as $song) {
            $itemColl[] = $this->hydrateSongItem($song);
        }
        return $itemColl;
    }

    /**
     * @param SongItem $song
     * @return ?SongItem
     * @throws NotFoundE
     */
    public function retrieveLyrics(SongItem $song) : ?SongItem
    {
        return $this->lyricsStorage?->fetch($song)?:null;
    }

    /**
     * @param array{artist:string, title:string, url:string, image:string} $song
     * @return SongItem
     */
    protected function hydrateSongItem(array $song): SongItem
    {
        $item = new SongItem();
        $item->title = $song['title'];
        $item->url = $song['url'];
        $item->imageUrl = $song['image'];
        $item->artist = $song['artist'];
        return $item;
    }
}