<?php
$myVar01 = 10;
if (isset($myVar01)) {
    echo "myVar01 已初始化";
} else {
    echo "myVar01 尚未初始化";
}

echo "<hr>";

if (isset($myVar02)) {
    echo "myVar02 已初始化";
} else {
    echo "myVar02 尚未初始化";
}

echo "<hr>";

$arr = ['春', '夏', '秋', '冬'];
if (isset($arr[0])) {
    echo "$arr[0]的值{$arr[0]}已初始化";
} else {
    echo "arr[0] 尚未初始化";
}

echo "<hr>";

if (isset($arr[4])) {
    echo "$arr[4]的值{$arr[4]}已初始化";
} else {
    echo "arr[4] 尚未初始化";
}