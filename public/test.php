<!DOCTYPE html>
<html lang="fr">
<head><title>aaa</title></head>
<body>aaa
<?php
class Toto
{
    public $nom = 'glos minet';
    public $opp = '';
}

function test_obj(Toto $obj)
{
    $obj->opp = 'titi';
}

$grosMinet = new Toto();
test_obj($grosMinet);
var_dump($grosMinet);
?>
</body>
</html>