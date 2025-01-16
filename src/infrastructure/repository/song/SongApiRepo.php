<?php
declare(strict_types=1);
namespace apispotify\infrastructure\repository\song;

use apispotify\infrastructure\repository\ApiRepoAbstract;
use apispotify\infrastructure\repository\song\contracts\SongServiceInterface;
use apispotify\model\Song\Song as SongItem;
use apispotify\model\Song\SongRepoInterface;
use apispotify\service\contracts\ConfigInterface;

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