<?php

namespace model\Playlist;

use model\Song\Song;

class Playlist
{
    public string|int $id = '';

    public string $title = '';
    public string $url = '';
    public ?string $imageUrl = '';

    /**
     * @var Song[]
     */
    public array $songs = [];

    public function getImageUrl(): ?string
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