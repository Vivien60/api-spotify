<?php
declare(strict_types=1);

namespace apispotify\view\templates\components;

use apispotify\view\templates\\Template;

class HeaderINPROGRESS extends Template
{

    public function render() : string
    {
        return <<<HTML
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>%s</title>
            <link rel="stylesheet" type="text/css" href="/css/mosaic.css" media="screen">
        HTML;
    }

    public function mainContent(): string
    {
        return '';
    }
}