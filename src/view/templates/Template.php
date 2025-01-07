<?php
declare(strict_types=1);

namespace view\templates;

use view\layouts\Layout;

abstract class Template
{
    protected Layout $layout;
    /**
     * @var string[]
     */
    public array $headers;
    public string $title = '';

    public string $footer = <<<FOOT
        <span>&copy; 2024 Phedra60. Tous droits réservés.</span>
        <span><a href="/rgpd.php">Politique de confidentialité</a></span>
    FOOT;
    public string $contentHeader = <<<CONTENT
        <nav>
            <div class="logo"><a href="/index.php"><img src="/img/the_shape_of_the_phoenix.png" height="150px"></a></div>
            <div class="headerTitle"><h1>%s</h1></div>
            <div class="menu"><a href="#">Menu 1</a><a href="#">Menu 2</a></div>
                <!-- autres liens de navigation -->
        </nav>
    CONTENT;



    /**
     * @param Layout $layout
     * @param string[] $headers
     */
    public function __construct(Layout $layout, array $headers = [])
    {
        $this->layout = $layout;
        $this->headers = $headers?:$this->defaultHeaders();
        $this->contentHeader = sprintf($this->contentHeader, $this->title);
    }

    /**
     * @return string[]
     */
    protected function defaultHeaders() : array
    {
        return [
            '<meta charset="UTF-8">',
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
            '<title>'.$this->title.'</title>',
            '<link rel="stylesheet" type="text/css" href="/css/mosaic.css" media="screen">'
        ];
    }

    /**
     * @param string[] $headers
     * @return $this
     */
    public function setHeaders(array $headers) : self
    {
        $this->headers = $headers;
        return $this;
    }

    public function header() : string
    {
        return implode(PHP_EOL, $this->headers);
    }

    abstract public function mainContent() : string;

    public function render() : string
    {
        $this->layout->mainContent = $this->mainContent();
        $this->layout->contentHeader = $this->contentHeader;
        $this->layout->footer = $this->footer;
        $this->layout->header = $this->header();

        return (string)$this->layout;
    }
}