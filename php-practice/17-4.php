<?php
class Grandpa {
    private $name = 'MarK Henry';
}

class Daddy extends Grandpa {
    function displayGrandpaName(){
        return $this->name;
    }
}

$daddy = new Daddy();
echo $daddy->displayGrandpaName(); // Warning: 沒有繼承到Grandpa的$name

echo "<hr>";
$outsiderWantstoKnowGrandpasName = new Grandpa();
echo $outsiderWantstoKnowGrandpasName->name; // Fatal Error: 不能對外宣揚秘密($name)