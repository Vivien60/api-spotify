<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\LyricsOvh\request;

use apispotify\infrastructure\dal\api\musicService\contracts\SongRqFactoryInterface;
use apispotify\infrastructure\dal\api\RequestAbstract;
use apispotify\model\Song\Song as SongItem;

class RequestFactory implements SongRqFactoryInterface
{
    public function lyrics(SongItem $song): RequestAbstract
    {
        return new Lyrics($song->artist, $song->title);
    }
}