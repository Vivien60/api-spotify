<?php
declare(strict_types=1);
namespace apispotify\infrastructure\repository\playlist;

use apispotify\infrastructure\repository\ApiRepoAbstract;
use apispotify\infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use apispotify\model\Playlist\Playlist as PlaylistItem;
use apispotify\model\Playlist\PlaylistRepoInterface;
use apispotify\model\User\User;
use apispotify\service\contracts\ConfigInterface;

class PlaylistApiRepo extends ApiRepoAbstract implements PlaylistRepoInterface
{
    public static ConfigInterface $config;

    public function __construct(?PlaylistServiceInterface $service = null)
    {
        $this->musicService = $service?:self::$config->playlistService;
        parent::__construct();
    }

    /**
     * @throws \Throwable
     */
    public function findById(int|string $id, User $user): ?PlaylistItem
    {
        $songs = $this->musicService->tracksFromUserPlaylist($user, $id);
        return $this->hydrateItem(["id" => $id, "songs" => $songs]) ;
    }

    /**
     * @throws \Throwable
     */
    public function findByUser(User $user): ?array
    {
        $results = $this->musicService->playlistsFromUser($user);
        return array_map([$this, 'hydrateItem'], $results);
    }

    /**
     * @param array{id: string, url: string, image: string, name: string, songs: array{title: string, url: string, image: string, artist: string} } $playlist
     * @return PlaylistItem
     */
    protected function hydrateItem(array $playlist): PlaylistItem
    {
        return PlaylistItem::fromArray($playlist);
    }
}