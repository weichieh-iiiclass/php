<?php
session_start();

$objResponse = [];
$objResponse['success'] = false;
$objResponse['info'] = '登入失敗';

if( !isset($_SESSION['username']) && !isset($_SESSION['identity']) ){
    header("Refresh: 3; url=../index.php");
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} 

if( $_SESSION['identity'] !== 'admin'){
    header("Refresh: 3; url=../index.php");
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}