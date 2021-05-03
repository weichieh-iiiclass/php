<?php

require_once './checkAdmin.php';
require_once '../db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "新增商品種類失敗";

if( $_POST['categoryName'] == ''){
    header("Refresh: 3; url=./category.php");
    $objResponse['info'] = "請填寫商品種類";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}

header("Refresh: 3; url=./category.php");

$sql = "INSERT INTO `categories` (`categoryName`) VALUES (?)";
$stmt = $pdo->prepare($sql);
// $arrParam = [$_POST['categoryName']];
// $stmt->execute($arrParam);
$stmt->execute([$_POST['categoryName']]);
if( $stmt->rowCount() > 0 ){
    $objResponse['success'] = true;
    $objResponse['info'] = "新增商品成功";
}
echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);