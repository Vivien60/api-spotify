<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";
require_once "../config/apiConfig.php";

use infrastructure\musicService\MusicServiceFactory;

session_start();
$service = MusicServiceFactory::defaultWithOAuth();
$urlRedirect = $service->urlForCode();
header('Location:'.$urlRedirect->url());