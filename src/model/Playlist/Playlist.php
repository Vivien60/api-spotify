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

    public function addSong(Song $song): void
    {
        $this->songs[] = $song;
    }

    public static function fromArray(array $playlist): self
    {
        $item = new static();
        $item->id = $playlist['id'];
        $item->title = $playlist['name'] ?? $item->title;
        $item->url = $playlist['url'] ?? $item->url;
        $item->imageUrl = $playlist['image'] ?? $item->imageUrl;
        if(isset($playlist['songs']))
            foreach ($playlist['songs'] as $songData) {
                $item->addSong(Song::fromArray($songData));
            }
        return $item;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'url' => $this->url,
            'image' => $this->imageUrl,
            'songs' => array_map([Song::class, 'toArray'], $this->songs)
        ];
    }

}