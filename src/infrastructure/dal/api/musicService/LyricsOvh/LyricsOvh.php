<?php
declare(strict_types=1);
namespace apispotify\infrastructure\dal\api\musicService\LyricsOvh;

use apispotify\infrastructure\dal\api\ClientAbstract;
use apispotify\infrastructure\dal\api\musicService\contracts\SongRqFactoryInterface;
use apispotify\infrastructure\repository\song\contracts\SongServiceInterface;
use apispotify\model\Song\Song as SongItem;
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

    /**
     * @throws \Throwable
     */
    public function lyricsFromSongProp(SongItem $song):string
    {
        $request = $this->requestFactory->lyrics($song);
        $response = $this->client->sendRequest($request);
        $parsedResponse = $this->parseResponse($response);
        return $this->parseSongItem($parsedResponse);
    }

    protected function parseResponse(ResponseInterface $response): ?StdClass
    {
        return json_decode($response->getBody()->getContents());
    }

    protected function parseSongItem(StdClass $item): string
    {
        return $item->lyrics;
    }
}