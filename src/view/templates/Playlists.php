<?php
declare(strict_types=1);

namespace apispotify\view\templates;

use apispotify\view\layouts\Layout;
use apispotify\view\templates\components\Component;

class Playlists extends Template
{
    public string $title = "Playlists";
    //public Profile $owner;
    private Component $typeList;

    public function __construct(Layout $layout, Component $typeList)
    {
        parent::__construct($layout);
        $this->typeList = $typeList;
    }

    public function mainContent() : string
    {
        $content = <<<HTML
            <div><h3>Eh bien, voici vos playlists !</h3></div>
        HTML;

        return $content.$this->typeList->render();
    }

}