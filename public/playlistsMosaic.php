<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";

use GuzzleHttp\Exception\RequestException;
use service\GetUserPlaylists;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlists;

session_start();
try {
    $getPlaylists = new GetUserPlaylists();
    $myPlaylists = $getPlaylists->forCurrentUser();
    $view = new Playlists(new ConnectedLayout(), new Mosaic($myPlaylists));
    echo $view->render();
} catch (RequestException $e) {
    traceRequestException($e, $e->getMessage());
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
    traceException($e, $e->getMessage());
}
