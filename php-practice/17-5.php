<?php
class People {
    public $strName;
    public $strGender;
    protected $intAge;
    protected $intHeight;
    protected $intWeight;

    public function setData($name, $gender, $age, $height, $weight){
        $this->strName = $name;
        $this->strGender = $gender;
        $this->intAge = $age;
        $this->intHeight = $height;
        $this->intWeight = $weight;
    }

    public function calcWeight(){
        return $this->intAge* 2 + 8;
    }
}

class AdultPeople extends People {
    public function calcWeight()
    {
        if($this->strGender==='男'){
            return ($this->intHeight-80) * 0.7;
        } else {
            return ($this->intHeight-70) * 0.6;
        }
    }
}

$objMan = new AdultPeople();
$objMan->setData("Darren", "男", 18, 150, 90);
echo $objMan->strName." 的標準體重為: ";
echo $objMan->calcWeight();

echo "<hr />";

$objMan = new AdultPeople();
$objMan->setData("Melody", "女", 17, 171, 55);
echo $objMan->strName." 的標準體重為: ";
echo $objMan->calcWeight();