<?php
declare(strict_types=1);
require_once "../src/autoload.php";
require_once "../config/Config.php";

use config\Config;
use exception\NotFoundE;
use model\Song\Song;
use service\ConfigDispatcher;
use view\layouts\ConnectedLayout;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());

$song = new Song();
$song->artist = $_GET["artist"];
$song->title = $_GET["item"];

try {
    $repo = Config::getInstance()->songRepo;
    $song = $repo->findBySongInfo($song);
} catch (NotFoundE $e) {
    $song->lyrics = "No lyrics found for this song.";
}

$view = new view\templates\Lyrics(new ConnectedLayout(), $song);
echo $view->render();