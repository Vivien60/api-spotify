<?php

namespace model\Song\BusinessLogic;

use contracts\MosaicItem;

class SongItem implements MosaicItem
{
    public string $title;
    public string $url;
    public string $imageUrl;
    public string $lyrics;
    public string $artist;

    public function __construct()
    {
    }

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