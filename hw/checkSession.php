<?php
session_start();

if (!isset($_SESSION['username']) ){
    session_destroy();

    header("Refresh: 3; url=./index.php");
    echo "請確實登入";
    exit();
}