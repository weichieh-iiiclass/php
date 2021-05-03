<?php

require_once("./checkSession.php"); //引入判斷是否登入機制
require_once("./db.inc.php"); //引用資料庫連線

$sql = "INSERT INTO `students`(`studentId`,`studentName`,`studentGender`,`studentBirthday`,`studentPhoneNumber`,`studentDescription`,`studentImg`)
VALUES (?,?,?,?,?,?,?)";

if ( $_FILES['studentImg']['error'] === 0) {
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES['studentImg']['name'],PATHINFO_EXTENSION);
    $imgFileName = $strDatetime.".".$extension;
    $isSuccess = move_uploaded_file($_FILES['studentImg']['tmp_name'],"./files/{$imgFileName}");

    if (!$isSuccess) {
        header("Refresh: 3; url=./admin.php");
        echo "圖片上傳失敗";
        exit();
    }
}

$arrParam = [
    $_POST['studentId'],
    $_POST['studentName'],
    $_POST['studentGender'],
    $_POST['studentBirthday'],
    $_POST['studentPhoneNumber'],
    $_POST['studentDescription'],
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