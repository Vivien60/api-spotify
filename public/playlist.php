<?php
require_once dirname(__FILE__,2) . "/src/autoload.php";
require_once dirname(__FILE__,2) . "/config/apiConfig.php";
require_once dirname(__FILE__,2).DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."utils".DIRECTORY_SEPARATOR."trace.php";

use exception\NotFoundE;
use model\Playlist\BusinessLogic\PlaylistItem;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlist;

session_start();

$tokenAdapter = new \model\Credentials\Persistence\OneFileAdapter(TOKEN_STORAGE_FILE);
$repoToken = new \model\Credentials\BusinessLogic\CredentialsRepo($tokenAdapter);
$token = $repoToken->ofCurrentUser();
$repoSong = new \model\Song\BusinessLogic\SongRepo(null, new \model\Song\Persistence\SpotifyAdapter($token));
$playlist = new PlaylistItem();
$playlist->id = htmlentities($_GET["item"]);
try {
    $myPlaylist = $repoSong->songsByPlaylist($playlist);
    $view = new Playlist(new ConnectedLayout(), new Mosaic($myPlaylist));
    echo $view->render();
} catch (NotFoundE $e) {
    traceException($e, $e->getMessage());
   echo  "Playlist not found";
} catch (Exception|Throwable $e) {
    echo "Unknown error";
    traceException($e, $e->getMessage());
}
