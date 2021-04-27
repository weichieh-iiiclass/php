<?php

session_start();

$username = 'test';
$pwd = sha1('test');

if (isset($_POST['username']) && isset($_POST['pwd'])) {
    if ($_POST['username'] === $username && sha1($_POST['pwd']) === $pwd) {
        header("Refresh: 3; url=./9-3-2-admin.php");
        $_SESSION['username'] = $_POST['username'];
        echo "登入成功! 3秒後自動進入後端頁面";
    } else {
        session_destroy();
        header("Refresh: 3; url=./9-3.php");
        echo  "登入失敗…3 秒後自動回登入頁";

    }
} else {
    session_destroy();
    header("Refresh: 3; url=./9-3.php");
    echo "請確實登入…3 秒後自動回登入頁";
}
