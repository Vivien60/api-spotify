<?php
declare(strict_types=1);

namespace apispotify\model\Song;

class Song
{
    public string $title;
    public string $artist;
    public string $url = '';
    public string $imageUrl = '';
    public string $lyrics = '' {
        get => nl2br($this->lyrics);
        set(string $value) => $value;
    }

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

    public static function fromArray(array $track): self
    {
        $item = new static();
        $item->title = $track['title'];
        $item->artist = $track['artist'];
        $item->url = $track['url'] ?? $item->url;
        $item->imageUrl = $track['image'] ?? $item->imageUrl;
        return $item;
    }

    public function toArray(): array
    {
        return [
            'title'     => $this->title,
            'url'       => $this->url,
            'image'     => $this->imageUrl,
            'lyrics'    => $this->lyrics,
            'artist'    => $this->artist,
        ];
    }
}