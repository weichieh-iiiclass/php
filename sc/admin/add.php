<?php
require_once './checkAdmin.php';
require_once '../db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = '新增失敗';

if( $_FILES['itemImg']['error'] === 0 ){
    $strDatetime = "item_}".date("YmdHis");
    $extension = pathinfo($_FILES['itemImg']['name'], PATHINFO_EXTENSION);
    $imgFileName = $strDatetime.".".$extension;
    $isSuccess = move_uploaded_file($_FILES['itemImg']['tmp_name'], "../imges/items/{$imgFileName}");

    if( !$isSuccess ){
        header("Refresh: 3; url=./admin.php");
        $objResponse['info'] = "圖片上傳失敗";
        exit();
    }
} 

//SQL 敘述
$sql = "INSERT INTO `items` (`itemName`, `itemImg`, `itemPrice`, `itemQty`, `itemCategoryId`) 
        VALUES (?, ?, ?, ?, ?)";

//繫結用陣列
$arrParam = [
    $_POST['itemName'],
    $imgFileName,
    $_POST['itemPrice'],
    $_POST['itemQty'],
    $_POST['itemCategoryId']
];

//取得 PDOstatement 物件
$stmt = $pdo->prepare($sql);

//執行預處理後的 SQL 語法
$stmt->execute($arrParam);

header("Refresh: 3; url=./admin.php");

//影響列數大於0，代表新增成功
if($stmt->rowCount() > 0) {
    $objResponse['success'] = true;
    $objResponse['info'] = "新增成功";  
}
echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);