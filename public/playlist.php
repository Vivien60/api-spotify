<?php
require_once dirname(__FILE__,2) . "/src/autoload.php";
require_once dirname(__FILE__, 2) . "/config/Config.php";
require_once dirname(__FILE__,2).DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."utils".DIRECTORY_SEPARATOR."trace.php";

use exception\NotFoundE;
use model\Playlist\BusinessLogic\PlaylistItem;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlist;

session_start();

$playlist = new PlaylistItem();
$playlist->id = htmlentities($_GET["item"]);
$service = new \service\GetUserPlaylists();
try {
    $myPlaylist = $service->byPlaylistIdForCurrentUser($playlist->id);
    $view = new Playlist(new ConnectedLayout(), new Mosaic($myPlaylist->songs));
    echo $view->render();
} catch (NotFoundE $e) {
    traceException($e, $e->getMessage());
   echo  "Playlist not found";
} catch (Exception|Throwable $e) {
    echo "Unknown error";
    traceException($e, $e->getMessage());
}
