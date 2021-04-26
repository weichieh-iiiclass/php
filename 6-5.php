<?php

$arrSeason = ['春', '夏', '秋', '冬'];
echo "每年的四季分別為： ";
foreach ($arrSeason as $value) {
    echo $value . "&nbsp;";
}

echo "<hr>";

//關聯式陣列(類似物件)
$arrPerson = [
    '學號' => '103',
    '姓名' => '孫小美',
    '性別' => '女',
    '生日' => '2000/7/15',
    '手機號碼' => '0939666999'
];

foreach ($arrPerson as $key => $value) {
    echo $key . ": " . $value . "<br>";
}

echo "<hr>";

$arrStudents = [];
$arrStudents[] = ["name" => "Alex", "age" => 18];
$arrStudents[] = ["name" => "Bill", "age" => 21];
$arrStudents[] = ["name" => "Carl", "age" => 13];
$arrStudents[] = ["name" => "Darren", "age" => 19];

// 可簡寫為foreach ($arrStudents as $obj){
foreach ($arrStudents as $key => $obj){
    echo"{$obj['name']} 今年{$obj['age']}歲 <br>";
}