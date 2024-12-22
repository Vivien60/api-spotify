<?php
require_once "../src/autoload.php";
require_once "../config/Config.php";

use exception\NotFoundE;
use GuzzleHttp\Exception\RequestException;
use model\Song\BusinessLogic\SongItem;
use model\Song\BusinessLogic\SongRepo;
use model\Song\Persistence\LyricsOvhAdapter;
use view\layouts\ConnectedLayout;

session_start();


$song = new SongItem();
$song->artist = $_GET["artist"];
$song->title = $_GET["item"];

try {
    /**
     * @TODO Vivien : voir pour coupler les 2 adaptateurs dans un meta-adaptateur, afin de masquer le fait qu'il y en ait 2
     */
    $repo = new SongRepo(new LyricsOvhAdapter(), null);
    $repo->retrieveLyrics($song);
} catch (NotFoundE $e) {
    $song->lyrics = "No lyrics found for this song.";
}

$view = new view\templates\Lyrics(new ConnectedLayout(), $song);
echo $view->render();