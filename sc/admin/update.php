<?php
require_once './checkAdmin.php';
require_once '../db.inc.php';

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = "沒有任何更新";

$arrParam = [];

$sql = "UPDATE `items` SET ";
$sql.= "`itemName` = ? ,";
$arrParam[] = $_POST['itemName'];

if( $_FILES['itemImg']['error'] === 0 ){
    $strDatetime = "item_".date("YmdHis");
    $extension = pathinfo($_FILES['itemImg']['name'], PATHINFO_EXTENSION);

    $itemImg = $strDatetime.".".$extension;
    $isSuccess = move_uploaded_file($_FILES['itemImg']['tmp_name'], "../images/items/{$itemImg}");

    if( $isSuccess) {
        $sqlGetImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
        $stmtGetImg = $pdo->prepare($sqlGetImg);

        //加入繫結陣列
        $arrGetImgParam = [
            (int)$_POST['itemId']
        ];

        //執行 SQL 語法
        $stmtGetImg->execute($arrGetImgParam);

        //若有找到 itemImg 的資料
        if($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的商品資料 (1筆)
            $arrImg = $stmtGetImg->fetchAll()[0];

            //若是 itemImg 裡面不為空值，代表過去有上傳過
            if($arrImg['itemImg'] !== NULL){
                //刪除實體檔案
                @unlink("../images/items/".$arrImg['itemImg']);
            } 

            //itemImg SQL 語句字串
            $sql.= "`itemImg` = ? ,";

            //僅對 itemImg 進行資料繫結
            $arrParam[] = $itemImg;
            
        }
    }
}

$sql.= "`itemPrice` = ? , 
        `itemQty` = ? , 
        `itemCategoryId` = ? 
        WHERE `itemId` = ? ";
$arrParam[] = $_POST['itemPrice'];
$arrParam[] = $_POST['itemQty'];
$arrParam[] = $_POST['itemCategoryId'];
$arrParam[] = (int)$_POST['itemId'];
$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


// header("Refresh: 3; url=./edit.php?itemId={$_POST['itemId']}");
header("Refresh: 3; url=./admin.php");


if( $stmt->rowCount()> 0 ){
    $objResponse['success'] = true;
    $objResponse['info'] = "更新成功";
}

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);