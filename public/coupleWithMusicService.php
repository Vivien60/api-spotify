<?php
require_once "../src/autoload.php";

use config\Config;
use service\ConfigDispatcher;

session_start();
$config = Config::getInstance();
ConfigDispatcher::dispatch($config);

$service = $config->playlistService;
$urlRedirect = $service->urlForCode();
header('Location:'.$urlRedirect->url());