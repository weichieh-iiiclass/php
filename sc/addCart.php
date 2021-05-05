<?php
session_start();
require_once './db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "加入購物車失敗";
$objResponse['cartItemNum'] = 0;

if( !isset($_POST['cartQty']) || !isset($_POST['itemId']) ){
    header("Refresh: 3; url=./itemList.php");
    $objResponse['info'] = "資料傳遞有誤";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}

if( !isset($_SESSION['cart']) ) $_SESSION['cart'] = [];

$sql = "SELECT COUNT(1) AS `count` FROM `items` WHERE `itemId` = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([ (int)$_POST['itemId'] ]);
$count = $stmt->fetchAll()[0]['count'];

if($count > 0){
    $_SESSION['cart'][]=[
        "itemId" => (int)$_POST['itemId'],
        "cartQty" => (int)$_POST['cartQty']
    ];

    header("Refresh: 3; url=./myCart.php");
    $objResponse['success'] = true;
    $objResponse['info'] = "已加入購物車";
    $objResponse['cartItemNum'] = count($_SESSION['cart']);

} else {
    header("Refresh: 3; url=./itemList.php");
    $objResponse['info'] = "查無商品項目";
    $objResponse['cartItemNum'] = count($_SESSION['cart']);
}

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);