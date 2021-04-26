<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>

    <?php
    $arrStudents = [];

    $arrStudents[] = [
        '學號' => '101',
        '姓名' => '阿土伯',
        '性別' => '男',
        '生日' => '2000/3/14',
        '手機號碼' => '0910123456'
    ];
    $arrStudents[] = [
        '學號' => '102',
        '姓名' => '錢夫人',
        '性別' => '女',
        '生日' => '2000/6/6',
        '手機號碼' => '0978222333'
    ];
    $arrStudents[] = [
        '學號' => '103',
        '姓名' => '孫小美',
        '性別' => '女',
        '生日' => '2000/7/15',
        '手機號碼' => '0939666999'
    ];
    $arrStudents[] = [
        '學號' => '104',
        '姓名' => '約翰喬',
        '性別' => '男',
        '生日' => '2000/8/7',
        '手機號碼' => '0910765432'
    ];
    ?>




    <?php
    for ($i = 0; $i < count($arrStudents); $i++) {
        echo "<table><tr>";
        echo "<td>學號</td><td>{$arrStudents[$i]['學號']}</td></tr><tr>";
        echo "<td>姓名</td><td>{$arrStudents[$i]['姓名']}</td></tr><tr>";
        echo "<td>性別</td><td>{$arrStudents[$i]['性別']}</td></tr><tr>";
        echo "<td>生日</td><td>{$arrStudents[$i]['生日']}</td></tr><tr>";
        echo "<td>手機號碼</td><td>{$arrStudents[$i]['手機號碼']}</td>";
        echo "</tr></table>";
    }

    ?>



</body>

</html>