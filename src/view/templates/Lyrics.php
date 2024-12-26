<?php

namespace view\templates;

use model\Song\Song as SongItem;
use view\layouts\Layout;

class Lyrics extends Template
{
    public string $title = '';
    private string $lyrics;

    public function __construct(Layout $layout, SongItem $songItem)
    {
        $this->title = $songItem->title;
        $this->lyrics = $songItem->lyrics;
        parent::__construct($layout);
    }
    public function mainContent(): string
    {
        return "<div class='container'>$this->lyrics</div>";
    }
}