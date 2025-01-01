<?php
declare(strict_types=1);
namespace infrastructure\repository\song;

use config\Config;
use contracts\SongRepoInterface;
use infrastructure\repository\ApiRepoAbstract;
use infrastructure\repository\song\contracts\SongServiceInterface;
use model\Playlist\Playlist as PlaylistItem;
use model\Song\Song as SongItem;
use stdClass;

class SongApiRepo extends ApiRepoAbstract implements SongRepoInterface
{
    public function __construct(?SongServiceInterface $service = null)
    {
        $this->musicService = $service?:Config::getInstance()->songService;
        parent::__construct();
    }

    public function findById(int|string $id): ?SongItem
    {
        //$this->requestFactory->playlistTracks()->fetch($playlist);
        return null;
    }

    public function findBySongInfo(SongItem $songItem): ?array
    {
        $result = $this->musicService->songFromSongProp($songItem);
        return $this->parseQResponse($result);
    }

    /**
     * @param array{title: string, url: string, image: string, artist: string} $song
     * @return SongItem
     */
    protected function hydrateItem(array $song): SongItem
    {
        $item = new SongItem();
        $item->title = $song['title'];
        $item->url = $song['url'];
        $item->imageUrl = $song['image'];
        $item->artist = $song['artist'];
        return $item;
    }

    protected function parseItem(stdClass $item): array
    {
        // TODO: Implement parseItem() method.
    }
}