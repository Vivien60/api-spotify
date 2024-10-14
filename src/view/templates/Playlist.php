<?php

namespace view\templates;

use view\layouts\ConnectedLayout;
use view\layouts\Layout;
use view\templates\components\Component;
use view\templates\components\Mosaic;

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
        $listSongs = $this->typeList;
        return "<div class='container'>Voici la playlist</div>".$this->typeList->render();
    }
}