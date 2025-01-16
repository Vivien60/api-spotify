<?php
declare(strict_types=1);
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";
require_once "../src/utils/trace.php";

use config\Config;
use GuzzleHttp\Exception\RequestException;
use apispotify\service\ConfigDispatcher;
use apispotify\service\GetUserPlaylists;
use apispotify\view\layouts\ConnectedLayout;
use apispotify\view\templates\components\Mosaic;
use apispotify\view\templates\Playlists;
session_start();
ConfigDispatcher::dispatch(Config::getInstance());

$serviceAuth = new apispotify\service\AuthenticatorService();
$serviceAuth->authenticate();
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
