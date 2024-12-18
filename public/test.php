<?php
class RecursiveObject {
    public $self;

    public function __construct() {
        $this->self = $this;
    }
}

$obj1 = new RecursiveObject();
$obj2 = new RecursiveObject();

try {
    $result = $obj1 == $obj2;
} catch (Error $e) {
    echo "Une erreur a été capturée : " . $e->getMessage();
}