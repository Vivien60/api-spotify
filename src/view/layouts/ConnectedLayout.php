<?php
declare(strict_types=1);

namespace apispotify\view\layouts;

class ConnectedLayout extends Layout
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString() : string
    {
        return parent::__toString();
    }
}