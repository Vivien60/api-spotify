<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";

require_once "../config/apiConfig.php";

use GuzzleHttp\Exception\RequestException;
use infrastructure\repository\auth\FileAuthUserRepo;
use infrastructure\repository\playlist\PlaylistApiRepo;
use model\User\User;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlists;

session_start();
try {
    $me = new User();
    $repo = new PlaylistApiRepo();
    $myPlaylists = $repo->findMyPlaylists($me);
    $view = new Playlists(new ConnectedLayout(), new Mosaic($myPlaylists));
    echo $view->render();
} catch (RequestException $e) {
    traceRequestException($e, $e->getMessage());
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
    traceException($e, $e->getMessage());
}
