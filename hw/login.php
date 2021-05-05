<?php

session_start();
require_once './db.inc.php';

if( isset($_POST['username']) && isset($_POST['pwd']) ){
    $sql = "SELECT `username`,`pwd`
            FROM `admin`
            WHERE `username` = ?
            AND `pwd` = ?";
    $arrParam = [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if( $stmt->rowCount() > 0 ){
        $_SESSION['username'] = $_POST['username'];

        header("Refresh: 3; url=./admin.php");
        echo '已成功登入!';
    } else {
        session_destroy();
        header("Refresh: 3; url=./index.php");
        echo '登入失敗~~請重新登入~~~';
    }

} else {
    session_destroy();
    header("Refresh: 3; url=./index.php");
    echo '請確實登入';
}