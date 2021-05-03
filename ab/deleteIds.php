<?php

require_once("./checkSession.php"); //引入判斷是否登入機制
require_once("./db.inc.php"); //引用資料庫連線

$strIds = join(",", $_POST['chk']);
$count = 0;

$sqlGetImg = "SELECT `studentImg` FROM `students` WHERE FIND_IN_SET(`id`, ?)";
$stmtGetImg = $pdo->prepare($sqlGetImg);
$stmtGetImg->execute([$strIds]);

if( $stmtGetImg->rowCount() >0 ){
    $arrImg = $stmtGetImg->fetchAll();

    for($i=0; $i<count($arrImg); $i++){
        if($arrImg[$i]['studentImg']!==NULL){
            @unlink("./files/{$arrImg[$i]['studentImg']}");
        }
    }
    
    $sqlDelete = "DELETE FROM `students` WHERE  FIND_IN_SET(`id`, ?)";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->execute([$strIds]);
    $count = $stmtDelete->rowCount();
}

header("Refresh: 3; url=./admin.php");
if($count>0){
    echo "刪除成功";
} else {
    echo "刪除失敗";
}

