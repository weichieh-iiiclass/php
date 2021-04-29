<?php

require_once("./checkSession.php"); //引入判斷是否登入機制
require_once("./db.inc.php"); //引用資料庫連線

$sql = "UPDATE `students`
        SET
        `studentId` = ?,
        `studentName` = ?,
        `studentGender` = ?,
        `studentBirthday` = ?,
        `studentPhoneNumber` = ?,
        `studentDescription` = ? ";

$arrParam = [
    $_POST['studentId'],
    $_POST['studentName'],
    $_POST['studentGender'],
    $_POST['studentBirthday'],
    $_POST['studentPhoneNumber'],
    $_POST['studentDescription']
];

if( $_FILES['studentImg']['error'] === 0) {
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES["studentImg"]["name"], PATHINFO_EXTENSION);
    $studentImg = $strDatetime.".".$extension;

    $isSuccess = move_uploaded_file($_FILES['studentImg']['tmp_name'],"./files/{$studentImg}");
    if($isSuccess){
        $sqlGetImg = "SELECT `studentImg` FROM `students` WHERE `id` = ?";
        $stmtGetImg = $pdo->prepare($sqlGetImg);
        $arrGetImgParam = [
            (int)$_POST['id']
        ];
        $stmtGetImg->execute($arrGetImgParam);

        if($stmtGetImg->rowCount() > 0){
            $arrImg = $stmtGetImg->fetchAll()[0];
            if($arrImg['studentImg']!==NULL){
                @unlink("./files/{$arrImg['studentImg']}");
            }

            $sql.=",";
            $sql.="`studentImg` = ? ";
            $arrParam[] = $studentImg;
        }
    }
}

$sql.="WHERE `id` = ?";
$arrParam[] = (int)$_POST['id'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0){
    header("Refresh: 3; url=./admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "沒有任何更新";
}