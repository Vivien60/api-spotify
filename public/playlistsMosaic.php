<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";

require_once "../config/apiConfig.php";

use GuzzleHttp\Exception\RequestException;
use model\Credentials\BusinessLogic\CredentialsRepo;
use model\Credentials\Persistence\OneFileAdapter;
use model\Playlist\BusinessLogic\PlaylistRepo;
use model\Playlist\Persistense\SpotifyAdapter;
use view\layouts\ConnectedLayout;
use view\templates\components\Mosaic;
use view\templates\Playlists;

session_start();
try {
    $tokenRepo = new CredentialsRepo(new OneFileAdapter(TOKEN_STORAGE_FILE));
    $token = $tokenRepo->ofCurrentUser();
    $playlistsAtSpotify = new PlaylistRepo(new SpotifyAdapter($token));
    $tokenRepo->saveIfRefreshed($token);
    $myPlaylists = $playlistsAtSpotify->getAllMyPlaylists();
    $view = new Playlists(new ConnectedLayout(), new Mosaic($myPlaylists));
    echo $view->render();
} catch (RequestException $e) {
    traceRequestException($e, $e->getMessage());
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
    traceException($e, $e->getMessage());
}
