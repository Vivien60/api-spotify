<?php
declare(strict_types=1);
require_once "../src/autoload.php";
require_once "../config/Config.php";

use config\Config;
use apispotify\exception\NotFoundE;
use apispotify\model\Song\Song;
use apispotify\service\ConfigDispatcher;
use apispotify\view\layouts\ConnectedLayout;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());

$song = new Song();
$song->artist = htmlentities($_GET["artist"]);
$song->title = htmlentities($_GET["item"]);

try {
    $repo = Config::getInstance()->songRepo;
    $song = $repo->findBySongInfo($song);
} catch (NotFoundE $e) {
    $song->lyrics = "No lyrics found for this song.";
}

$view = new apispotify\view\templates\Lyrics(new ConnectedLayout(), $song);
echo $view->render();