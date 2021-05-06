<?php
$regex = "/[a-zA-Z]+/";
$test = "You are the only one we love.";

if( preg_match($regex, $test, $matches)){
    echo '<pre>';
    print_r($matches);
    echo '</pre>';
    echo "比對成功! 結果為: {$matches[0]}";
} else {
    echo "比對失敗...";
}