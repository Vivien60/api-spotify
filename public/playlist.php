<?php
require_once dirname(__FILE__,2) . "/src/autoload.php";
require_once dirname(__FILE__,2).DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."utils".DIRECTORY_SEPARATOR."trace.php";

use config\Config;
use service\ConfigDispatcher;
use exception\NotFoundE;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlist;

session_start();
ConfigDispatcher::dispatch(Config::getInstance());

$serviceAuth = new \service\AuthenticatorService();
$serviceAuth->authenticate();

$service = new \service\GetUserPlaylists();
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
