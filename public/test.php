<?php
declare(strict_types=1);
require_once "../src/autoload.php";
use config\Config;
use apispotify\service\ConfigDispatcher;
error_reporting(E_ALL);
session_start();
/*ConfigDispatcher::dispatch(Config::getInstance());;
$client = new infrastructure\dal\api\Spotify\client\Client();
$requestFactory = new infrastructure\dal\api\Spotify\request\RequestFactory();
$auth = Config::getInstance()->authUserRepo->fetchById();
$response = json_decode(
    $client->sendRequest(
        $requestFactory->playlistTracks($auth, "2GmDHTvf8cxAfWehlT16Up")
    )->getBody()->getContents());
*/

$ch = curl_init();

$url = "https://api.musixmatch.com/ws/v1.1/track.lyrics.get?=DEVQ71800002";
$url.="&apikey=d69b62b8f56d0e61eb707fc9fa7441b4";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);


//TEST-a correction 1

//TEST B new functionality