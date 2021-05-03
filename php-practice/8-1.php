<?php

function sayHelloWorld(){
    echo "Hello World!";
}

sayHelloWorld();

echo "<hr>";

function greeting($strName){
    $str = "哈囉，{$strName}";
    return $str;
}

$strName = "Jessica";
$strResult = greeting($strName);

echo $strResult;

echo "<hr>";

function get_X_times_Y ($a,$b){
    return $a*$b;
}

$x=3;
$y=4;
echo get_X_times_Y($x,$y);