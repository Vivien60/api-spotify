<?php

namespace view\templates\components;

abstract class Component
{

    abstract public function render() : string;
}