<?php
declare(strict_types=1);

namespace apispotify\view\templates\components;

abstract class Component
{

    abstract public function render() : string;
}