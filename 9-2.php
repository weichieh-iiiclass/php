<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9-2</title>
</head>

<body>
    <?php

    $_SESSION['myName'] = 'Jessica';
    $myName = $_SESSION['myName'];

    echo "我的名字: {$_SESSION['myName']}從session<br>";
    echo "我的名字: {$myName}從變數<br>";

    echo "<hr>";

    $_SESSION['student']['name'] = 'Jessica Huang';
    $_SESSION['student']['age'] = '18';
    $_SESSION['student']['height'] = '170';
    $_SESSION['student']['weight'] = '45';

    echo "全名: {$_SESSION['student']['name']} <br>";
    echo "年齡: {$_SESSION['student']['age']} <br>";
    echo "身高: {$_SESSION['student']['height']} <br>";
    echo "體重: {$_SESSION['student']['weight']} <br>";


    ?>
</body>

</html>