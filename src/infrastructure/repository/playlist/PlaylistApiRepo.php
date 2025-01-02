<?php
declare(strict_types=1);
namespace infrastructure\repository\playlist;

use service\contracts\ConfigInterface;
use contracts\PlaylistRepoInterface;
use infrastructure\repository\ApiRepoAbstract;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use model\Playlist\Playlist as PlaylistItem;
use model\Song\Song;
use model\User\User;
use stdClass;

class PlaylistApiRepo extends ApiRepoAbstract implements PlaylistRepoInterface
{
    public static ConfigInterface $config;

    public function __construct(?PlaylistServiceInterface $service = null)
    {
        $this->musicService = $service?:self::$config->playlistService;
        parent::__construct();
    }

    public function findById(int|string $id, User $user): ?PlaylistItem
    {
        $playlist = new PlaylistItem();
        $playlist->id = $id;
        $results = $this->musicService->tracksFromUserPlaylist($user, $id);
        $playlist->songs = array_map([$this, 'hydrateSongItem'], $results);

        return $playlist;
    }

    public function findByUser(User $user): ?array
    {
        $results = $this->musicService->playlistsFromUser($user);
        return array_map([$this, 'hydrateItem'], $results);
    }

    /**
     * @param array{id: string, url: string, image: string, name: string} $playlist
     * @return PlaylistItem
     */
    protected function hydrateItem(array $playlist): PlaylistItem
    {
        $item = new PlaylistItem();
        $item->id = $playlist['id'];
        $item->title = $playlist['name'];
        $item->url = $playlist['url'];
        $item->imageUrl = $playlist['image'];
        return $item;
    }

    /**
     * @param array{title: string, url: string, image: string, artist: string} $track
     * @return Song
     */
    protected function hydrateSongItem(array $track): Song
    {
        $item = new Song();
        $item->title = $track['title'];
        $item->url = $track['url'];
        $item->imageUrl = $track['image'];
        $item->artist = $track['artist'];
        return $item;
    }
}