<?php

namespace model\Song;

class Song
{
    public string $title;
    public string $url;
    public string $imageUrl;
    public string $lyrics {
        get => nl2br($this->lyrics);
        set(string $value) => $value;
    }
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