<?php

require_once './checkSession.php';
require_once './db.inc.php';

$sql = "UPDATE `members`
        SET
        `mName` = ?,
        `mGender` = ?,
        `mBirth` = ?,
        `mLocation` = ?,
        `mWishGender` = ?,
        `mWishDescription` = ? ";

$arrParam = [
    $_POST['mName'],
    $_POST['mGender'],
    $_POST['mBirth'],
    $_POST['mLocation'],
    $_POST['mWishGender'],
    $_POST['mWishDescription']
];

if( $_FILES['mImg']['error'] === 0) {
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES["mImg"]["name"], PATHINFO_EXTENSION);
    $mImg = $strDatetime.".".$extension;

    $isSuccess = move_uploaded_file($_FILES['mImg']['tmp_name'],"./files/{$mImg}");

    if($isSuccess){
        $sqlGetImg = "SELECT `mImg` FROM `members` WHERE `mId` = ?";
        $stmtGetImg = $pdo->prepare($sqlGetImg);
        $arrGetImgParam = [
            (int)$_POST['mId']
        ];
        $stmtGetImg->execute($arrGetImgParam);

        if($stmtGetImg->rowCount() > 0){
            $arrImg = $stmtGetImg->fetchAll()[0];
            if($arrImg['mImg']!==NULL){
                @unlink("./files/{$arrImg['mImg']}");
            }

            $sql.=",";
            $sql.="`mImg` = ? ";
            $arrParam[] = $mImg;
        }
    }

}
$sql.="WHERE `mId` = ?";
$arrParam[] = (int)$_POST['mId'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0){
    header("Refresh: 3; url=./admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "沒有任何更新";
}