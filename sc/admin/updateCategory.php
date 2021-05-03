<?php

require_once './checkAdmin.php';
require_once '../db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "沒有任何更新";


if( $_POST['categoryName'] == '' ){
    header("Refresh: 3; url=./editCategory.php?editCategoryId={$_POST['editCategoryId']}");
    $objResponse['info'] = "請填寫商品種類";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}

header("Refresh: 3; url=./editCategory.php?editCategoryId={$_POST['editCategoryId']}");

$sql = "UPDATE `categories`
        SET `categoryName` = ?
        WHERE `categoryId` = ?";
$stmt = $pdo->prepare($sql);
$arrParam =[
    $_POST['categoryName'],
    (int)$_POST['editCategoryId']
];
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    $objResponse['success'] = true;
    $objResponse['info'] = "更新成功";
}

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);