<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    session_destroy();
    header("Refresh: 3; url=./9-3.php");
    echo "您已登出…3 秒後自動回登入頁";
} else {
    session_destroy();
}
