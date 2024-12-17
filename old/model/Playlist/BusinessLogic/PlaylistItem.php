<?php

namespace model\Playlist\BusinessLogic;

use contracts\MosaicItem;
use model\Song\BusinessLogic\SongItem;

class PlaylistItem implements MosaicItem
{
    public string|int $id = '';

    public string $title = '';
    public string $url = '';
    public string $imageUrl = '';

    /**
     * @var SongItem[]
     */
    public array $songs = [];

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}