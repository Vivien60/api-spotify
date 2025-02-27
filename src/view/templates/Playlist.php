<?php
declare(strict_types=1);

namespace apispotify\view\templates;

use apispotify\view\layouts\Layout;
use apispotify\view\templates\components\Component;

class Playlist extends Template
{
    public string $title = 'Playlist';
    private Component $typeList;

    public function __construct(Layout $layout, Component $typeList)
    {
        parent::__construct($layout);
        $this->typeList = $typeList;
    }
    public function mainContent(): string
    {
        return "<div class='container'>Voici la playlist</div>".$this->typeList->render();
    }
}