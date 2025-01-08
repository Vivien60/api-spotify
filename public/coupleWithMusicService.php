<?php
declare(strict_types=1);
require_once "../src/autoload.php";
require_once "../src/utils/trace.php";

use config\Config;
use service\ConfigDispatcher;

session_start();
$config = Config::getInstance();
ConfigDispatcher::dispatch($config);

$service = new \service\OAuthService();
$urlRedirect = $service->processForCodeDemand($config->playlistService);
header('Location:'.$urlRedirect->url());