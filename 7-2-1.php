<?php
echo "我的姓名: {$_POST['myName']}<br>";
echo "我的年紀: {$_POST['myAge']}<br>";
echo "我的身高: {$_POST['myHeight']}<br>";
echo "我的體重: {$_POST['myWeight']}<br>";

echo "<hr>";

if(isset($_POST['myName'])) { 
    echo '有 $_POST["myName"]'; 
} else { 
    echo '沒有 $_POST["myName"]'; 
}