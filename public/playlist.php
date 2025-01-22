<?php
declare(strict_types=1);
require_once dirname(__FILE__,2) . "/src/autoload.php";
require_once dirname(__FILE__,2).DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."utils".DIRECTORY_SEPARATOR."trace.php";

use config\Config;
use apispotify\service\ConfigDispatcher;
use apispotify\exception\NotFoundE;
use apispotify\view\layouts\ConnectedLayout;
use apispotify\view\templates\components\Mosaic;
use apispotify\view\templates\Playlist;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());

$serviceAuth = new apispotify\service\AuthenticatorService();
$serviceAuth->authenticate();

$service = new apispotify\service\GetUserPlaylists();
try {
    $myPlaylist = $service->byPlaylistIdForCurrentUser(htmlentities($_GET["item"]));
    $view = new Playlist(new ConnectedLayout(), new Mosaic($myPlaylist->songs));
    echo $view->render();
} catch (NotFoundE $e) {
    traceException($e, $e->getMessage());
   echo  "Playlist not found";
} catch (Exception|Throwable $e) {
    echo "Unknown error";
    traceException($e, $e->getMessage());
}
