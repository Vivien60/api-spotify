<?php
namespace infrastructure\dal\api\musicService\LyricsOvh;

use infrastructure\dal\api\LyricsOvh\client\Client;
use infrastructure\dal\api\musicService\contracts\SongRqFactoryInterface;
use infrastructure\repository\song\contracts\SongServiceInterface;
use model\Song\Song as SongItem;
use Psr\Http\Message\ResponseInterface;

class LyricsOvh implements SongServiceInterface
{
    public function __construct(
        private Client $client,
        private SongRqFactoryInterface $requestFactory,
    )
    {
    }

    public function songFromSongProp(SongItem $song):ResponseInterface
    {
        $request = $this->requestFactory->lyrics($song);

        return  $this->client->sendRequest($request);
    }
}