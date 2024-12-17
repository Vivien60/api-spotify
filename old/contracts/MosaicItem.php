<?php

namespace contracts;

interface MosaicItem
{
    public function getImageUrl() : string;
    public function getUrl() : string;
    public function getTitle() : string;
}