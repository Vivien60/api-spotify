<?php
declare(strict_types=1);

namespace view\templates\components;

use Iterator;
use view\templates\components\Component;
use contracts\MosaicItem;

class Mosaic extends Component
{
    /**
     * @var Iterator<MosaicItem>|MosaicItem[]
     */
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