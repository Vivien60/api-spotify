<?php
require_once "../src/autoload.php";
require_once "../config/Config.php";

use infrastructure\repository\song\SongApiRepo;
use model\Song\Song;
use view\layouts\ConnectedLayout;
use exception\NotFoundE;

session_start();

$song = new Song();
$song->artist = $_GET["artist"];
$song->title = $_GET["item"];

try {
    $repo = new SongApiRepo();
    $song = $repo->findBySongInfo($song);
} catch (NotFoundE $e) {
    $song->lyrics = "No lyrics found for this song.";
}

$view = new view\templates\Lyrics(new ConnectedLayout(), $song);
echo $view->render();