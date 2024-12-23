<?php
require_once "../src/autoload.php";
require_once "../vendor/autoload.php";

use config\Config;
use infrastructure\musicService\MusicServiceFactory;

session_start();
$config = Config::getInstance();
$service = $config->musicService;
$urlRedirect = $service->urlForCode();
header('Location:'.$urlRedirect->url());