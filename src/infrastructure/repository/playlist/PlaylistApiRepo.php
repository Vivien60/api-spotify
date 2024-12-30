<?php
declare(strict_types=1);
namespace infrastructure\repository\playlist;

use config\Config;
use contracts\PlaylistRepoInterface;
use infrastructure\repository\ApiRepoAbstract;
use infrastructure\repository\playlist\contracts\PlaylistServiceInterface;
use model\Playlist\Playlist as PlaylistItem;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class PlaylistApiRepo extends ApiRepoAbstract implements PlaylistRepoInterface
{
    public function __construct(?PlaylistServiceInterface $service = null)
    {
        $this->musicService = $service?:Config::getInstance()->playlistService;
        parent::__construct();
    }

    public function findById(int|string $id, User $user): ?PlaylistItem
    {
        $this->musicService->songsFromUserPlaylist($user, $id);
        return null;
    }

    public function findByUser(User $user): ?array
    {
        $result = $this->musicService->playlistFromUser($user);
        return $this->parseQResponse($result);
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
}