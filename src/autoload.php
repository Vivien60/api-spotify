<?php
function autoload1247575(string $nomClasse) : void {
    $class = implode(DIRECTORY_SEPARATOR, [
        "..",
        "src",
        str_replace("\\", DIRECTORY_SEPARATOR, "$nomClasse.php"),
    ]);
    include $class;
}

spl_autoload_register('autoload1247575');

require_once dirname(__FILE__,2) . "/vendor/autoload.php";
