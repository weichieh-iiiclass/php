<?php

session_start();
session_destroy();
header("Refresh: 3; url=./index.php");
echo '登出成功';