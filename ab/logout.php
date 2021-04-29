<?php

session_start();
session_destroy();
header("Refresh: 9; url=./index.php");
require_once("./templates/logout.html");