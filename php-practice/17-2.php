<?php
class Grandpa {
    public $name = 'MarK Henry';
}

class Daddy extends Grandpa {
    function displayGrandpaName(){
        return $this->name;
    }
}

$daddy = new Daddy();
echo $daddy->displayGrandpaName(); // Prints 'Mark Henry'

echo "<hr>";
$outsiderWantstoKnowGrandpasName = new Grandpa();
echo $outsiderWantstoKnowGrandpasName->name; // Prints 'Mark Henry'

