<?php
declare(strict_types=1);
function autoload_apiSpotify_1247575(string $nomClasse) : void {
    $prefix = "apispotify";
    $len = strlen($prefix);
    if (strncmp($prefix, $nomClasse, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    $nomClasse = substr($nomClasse, $len+1);
    $baseDir =dirname(__DIR__).DIRECTORY_SEPARATOR."src";
    $srcClass = implode(DIRECTORY_SEPARATOR, [
        $baseDir,
        str_replace("\\", DIRECTORY_SEPARATOR, "$nomClasse.php"),
    ]);
    if(file_exists($srcClass)) {
        include $srcClass;
        return;
    }
}

/**
 * @param string $nomClasse
 * @return string
 */
function configFiles_1247575(string $nomClasse): void
{
    if(!(stripos($nomClasse, 'config') !== false)) {
        return;
    }
    $class = implode(DIRECTORY_SEPARATOR, [
        dirname(__DIR__),
        str_replace("\\", DIRECTORY_SEPARATOR, "$nomClasse.php"),
    ]);
    if(file_exists($class)) {
        include $class;
        return;
    }
}
spl_autoload_register('autoload_apiSpotify_1247575');
spl_autoload_register('configFiles_1247575');

require_once dirname(__FILE__,2) . "/vendor/autoload.php";
