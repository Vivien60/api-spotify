<?php
declare(strict_types=1);
namespace infrastructure\repository\song;

use infrastructure\repository\ApiRepoAbstract;
use infrastructure\repository\song\contracts\SongServiceInterface;
use model\Song\Song as SongItem;
use model\Song\SongRepoInterface;
use service\contracts\ConfigInterface;

class SongApiRepo extends ApiRepoAbstract implements SongRepoInterface
{
    public static ConfigInterface $config;
    public function __construct(?SongServiceInterface $service = null)
    {
        $this->musicService = $service?:self::$config->songService;
        parent::__construct();
    }

    public function findById(int|string $id): ?SongItem
    {
        //$this->requestFactory->playlistTracks()->fetch($playlist);
        return null;
    }

    public function findBySongInfo(SongItem $songItem): ?SongItem
    {
        $songItem->lyrics = $this->musicService->lyricsFromSongProp($songItem);
        return $songItem;
    }

    /**
     * @param array{title: string, url: string, image: string, artist: string} $song
     * @return SongItem
     */
    protected function hydrateItem(array $song): SongItem
    {
        return SongItem::fromArray($song);
    }
}