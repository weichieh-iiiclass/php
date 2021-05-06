<?php
class Grandpa {
    protected $name = 'MarK Henry';
}

class Daddy extends Grandpa {
    function displayGrandpaName(){
        return $this->name;
    }
}

$daddy = new Daddy();
echo $daddy->displayGrandpaName(); // Prints 'Mark Henry'(繼承者可使用被保護的資訊)

echo "<hr>";
$outsiderWantstoKnowGrandpasName = new Grandpa();
echo $outsiderWantstoKnowGrandpasName->name; // Fatal Error: 只有繼承者可以使用被保護的資訊