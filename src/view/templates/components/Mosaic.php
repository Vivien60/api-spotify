<?php
declare(strict_types=1);

namespace apispotify\view\templates\components;

use Iterator;

class Mosaic extends Component
{
    public Iterator|array $items;

    /**
     * @param array|Iterator $items
     */
    public function __construct(Iterator|array $items)
    {
        $this->items = $items;
    }

    public function renderElt() : Iterator
    {
        $html = "<div class=\"mosaicElt\" style=\"background-image:url('%s')\"><div class=\"transbox\"><p><a href=\"%s\">%s</a></p></div></div>";
        foreach ($this->items as $item) {

            yield sprintf($html, $item->getImageUrl(), $item->getUrl(), $item->getTitle());
        }

        yield "</div>";
    }

    public function render() : string
    {
        $content = '<div class="mosaicList">';
        foreach($this->renderElt() as $eltContent)
            $content .= $eltContent;
        $content .= "</div>";
        return $content;
    }
}