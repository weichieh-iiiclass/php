<?php

$arr = ['Alex','Bill','Carl','Darren'];
echo "印出 {$arr[3]}";

echo "<hr>";

$arr[]= "Eric";
$arr[]= "Fox";

echo "新增了{$arr[4]} 和 {$arr[5]}";

echo "<hr>";

for($i=0; $i<count($arr); $i++){
    echo $arr[$i] . "&nbsp;";
}