<?php

require_once './checkSession.php';
require_once './db.inc.php';

$strIds = join(",", $_POST['chk']);
$count = 0;

$sqlGetImg = "SELECT `mImg` FROM `members` WHERE FIND_IN_SET(`mId`, ?)";
$stmtGetImg = $pdo->prepare($sqlGetImg);
$stmtGetImg->execute([$strIds]);

if( $stmtGetImg->rowCount() >0 ){
    $arrImg = $stmtGetImg->fetchAll();

    for($i=0; $i<count($arrImg); $i++){
        if($arrImg[$i]['mImg']!==NULL){
            @unlink("./files/{$arrImg[$i]['mImg']}");
        }
    }
    
    $sqlDelete = "DELETE FROM `members` WHERE  FIND_IN_SET(`mId`, ?)";
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

