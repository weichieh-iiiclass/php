<?php

require_once './checkAdmin.php';
require_once '../db.inc.php';

$total = $pdo->query("SELECT COUNT(1) AS `count` FROM `items`")->fetchAll()[0]['count']; //count??

$numPerPage = 5 ;
$totalPages = ceil($total/$numPerPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = $page < 1 ? 1 : $page;

$totalCategories = $pdo->query("SELECT COUNT(1) AS `count` FROM `categories`")->fetchAll()[0]['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .border {
        border: 1px solid;
    }
    img.itemImg {
        width: 250px;
    }
    </style>
</head>
<body>
    <?php require_once './templates/title.php' ?>

    <h3>商品列表</h3>

    <?php
    if( $totalCategories > 0 ){

    } else {
        echo "請先建立商品類別";
    }
    ?>

</body>
</html>