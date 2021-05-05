<?php

require_once './checkSession.php';
require_once './db.inc.php';

$sql = "INSERT INTO `members`(`mName`, `mGender`, `mBirth`, `mLocation`, `mWishGender`, `mWishDescription`, `mImg`) VALUES (?,?,?,?,?,?,?)";

if($_FILES['mImg']['error'] === 0){
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES['mImg']['name'],PATHINFO_EXTENSION);
    $imgFileName = $strDatetime.".".$extension;
    $isSuccess = move_uploaded_file($_FILES['mImg']['tmp_name'],"./files/{$imgFileName}");

    if (!$isSuccess) {
        header("Refresh: 3; url=./admin.php");
        echo "圖片上傳失敗";
        exit();
    }
}

$arrParam = [
    $_POST['mName'],
    $_POST['mGender'],
    $_POST['mBirth'],
    $_POST['mLocation'],
    $_POST['mWishGender'],
    $_POST['mWishDescription'],
    $imgFileName
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
if($stmt->rowCount() > 0){
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./new.php");
    echo "新增失敗";
}