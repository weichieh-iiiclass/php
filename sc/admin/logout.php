<?php
session_start();
session_destroy();

header("Refresh: 3; url=../index.php");

$objResponse = [];
$objResponse['success'] = 'true';
$objResponse['info'] = "您已登出";

echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);