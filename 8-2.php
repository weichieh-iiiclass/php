<?php

$msg = "這是全域變數<br>";

function showMsg(){
    $msg = "這是區域變數<br>";
    echo $msg;
}

echo $msg; //先輸出全域變數的值
showMsg(); //透過函式輸出區域變數的值
echo $msg; //最後再輸出全域變數的值
