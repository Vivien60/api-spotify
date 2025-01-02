<?php
namespace infrastructure\dal\api\musicService\LyricsOvh;

use infrastructure\dal\api\ClientAbstract;
use infrastructure\dal\api\musicService\contracts\SongRqFactoryInterface;
use infrastructure\repository\song\contracts\SongServiceInterface;
use model\Song\Song as SongItem;
use Psr\Http\Message\ResponseInterface;
use stdClass;

class LyricsOvh implements SongServiceInterface
{
    public function __construct(
        private ClientAbstract $client,
        private SongRqFactoryInterface $requestFactory,
    )
    {
    }

    public function lyricsFromSongProp(SongItem $song):string
    {
        $request = $this->requestFactory->lyrics($song);
        $response = $this->client->sendRequest($request);
        $parsedResponse = $this->parseResponse($response);
        return $this->parseSongItem($parsedResponse);
    }

    protected function parseResponse(ResponseInterface $response): ?StdClass
    {
        return json_decode($response->getBody());
    }

    protected function parseSongItem(StdClass $item): string
    {
        return $item->lyrics;
    }
}