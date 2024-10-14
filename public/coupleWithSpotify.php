<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";
require_once "../config/apiConfig.php";

use persistenceclient\api\Spotify\client\ClientForToken;
use persistenceclient\api\Spotify\utils\UrlForCode;

session_start();
$urlRedirect = new UrlForCode(new ClientForToken(),CLIENT_ID, REDIRECT_URI);
header('Location:'.$urlRedirect->url());