<?php
require_once "../src/autoload.php";

use config\Config;

session_start();
$config = Config::getInstance();
$service = $config->playlistService;
$urlRedirect = $service->urlForCode();
header('Location:'.$urlRedirect->url());