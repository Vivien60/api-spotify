<?php
declare(strict_types=1);

namespace infrastructure\dal\api\LyricsOvh\request;

use infrastructure\dal\api\musicService\contracts\SongRqFactoryInterface;
use infrastructure\dal\api\RequestAbstract;
use model\Song\Song as SongItem;

class RequestFactory implements SongRqFactoryInterface
{
    public function lyrics(SongItem $song): RequestAbstract
    {
        return new Lyrics($song->artist, $song->title);
    }
}