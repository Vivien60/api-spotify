<?php
declare(strict_types=1);

namespace apispotify\infrastructure\dal\api\musicService\contracts;

use apispotify\infrastructure\dal\api\RequestAbstract;
use apispotify\model\Song\Song as SongItem;

interface SongRqFactoryInterface
{
    public function lyrics(SongItem $song):RequestAbstract;
}