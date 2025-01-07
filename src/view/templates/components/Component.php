<?php
declare(strict_types=1);

namespace view\templates\components;

abstract class Component
{

    abstract public function render() : string;
}