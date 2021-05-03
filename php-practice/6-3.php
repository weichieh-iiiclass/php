<?php
$myArray = [
    'myName' => 'Alex',
    'myHeight' => 160,
    'myWeight' => 70
];

$myArray = [];
$myArray['myName'] = 'Alex';
$myArray['myHeight'] = 160;
$myArray['myWeight'] = 70;
echo "大家好，我的名字是" . $myArray['myName'] . ",";
echo "我的身高是{$myArray['myHeight']}, ";
echo "我的體重是{$myArray['myWeight']}, ";
