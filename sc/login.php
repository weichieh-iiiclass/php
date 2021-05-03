<?php

session_start();
require_once './db.inc.php';

$objResponse['success'] = false;
$objResponse['info'] = "登入失敗";

if( isset($_POST['username']) && isset($_POST['pwd']) ){
    switch($_POST['identity']){
        case 'admin':
            $sql = "SELECT `username`, `pwd`, `name`
                    FROM `admin`
                    WHERE `username` = ?
                    AND `pwd` = ?";
        break;

        case 'users':
            $sql = "SELECT `username`, `pwd`, `name`
            FROM `users`
            WHERE `username` = ?
            AND `pwd` = ?
            AND `isActived` = 1";
        break;

    }
    $arrParam = [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if( $stmt->rowCount() > 0){
        $arr = $stmt->fetchAll()[0];

        if( $_POST['identity'] === 'admin'){
            header("Refresh: 3; url=./admin/admin.php");
        } elseif( $_POST['identity'] === 'users') {
            header("Refresh: 3; url=./index.php");
        }

        $_SESSION['username'] = $arr['username'];
        $_SESSION['name'] = $arr['name'];
        $_SESSION['identity'] = $_POST['identity'];

        $objResponse['success'] = true;
        $objResponse['info'] = "登入成功";
        echo json_encode($objResponse,JSON_UNESCAPED_UNICODE);
        exit();
    } 
} else {
    $objResponse['info'] = "請確實登入";
    
}

header("Refresh: 3; url=./index.php");
echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);