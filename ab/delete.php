<?php

require_once("./checkSession.php"); //引入判斷是否登入機制
require_once("./db.inc.php"); //引用資料庫連線

// (一) 刪除實體照片
//選擇特定id的照片檔名
$sqlGetImg = "SELECT `studentImg` FROM `students` WHERE `id` = ?";
$stmtGetImg = $pdo->prepare($sqlGetImg); // 將資料做pdo的prepare

//取得我選擇的刪除按鈕那列回傳url裡的id值
$arrGetImgParam = [
    (int)$_GET['id']
];

$stmtGetImg->execute($arrGetImgParam); // 將prepare後的資料執行 SQL 語法

if($stmtGetImg->rowCount() > 0){
    $arrImg = $stmtGetImg->fetchAll()[0]; // 因為選擇的只有一筆,所以可以指定[0]
    if($arrImg['studentImg']!==NULL){
        @unlink("./files/{$arrImg['studentImg']}"); //刪除實體檔案
    }
}

// (二) 刪除那筆資料
$sql = "DELETE FROM `students` WHERE `id` = ?";
$arrParam = [
    (int)$_GET['id']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0){
    header("Refresh: 3; url=./admin.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗";
}