<?php
declare(strict_types=1);
namespace infrastructure\repository\playlist;

use contracts\PlaylistRepoInterface;
use infrastructure\musicService\MusicServiceFactory;
use infrastructure\repository\ApiRepoAbstract;
use model\Playlist\Playlist as PlaylistItem;
use model\User\User;
use Psr\Http\Message\ResponseInterface;

class PlaylistApiRepo extends ApiRepoAbstract implements PlaylistRepoInterface
{

    public function __construct()
    {
        parent::__construct(MusicServiceFactory::playlistService());
    }

    public function findById(int $id): ?PlaylistItem
    {
        //$this->requestFactory->playlistTracks()->fetch($playlist);
        return null;
    }

    public function findByUser(User $user): ?array
    {
        $result = $this->musicService->fromUser($user);
        return $this->parseQResponse($result);
    }

    protected function parseQResponse(ResponseInterface $results): array
    {
        $items = [];
        foreach ($results as $playlist) {
            $items[] = $this->hydrateItem($playlist);
        }
        return $items;
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