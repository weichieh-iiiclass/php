<?php
$regex = "/[a-zA-Z]+/";
$test = "You are the only one we love.";

if( preg_match_all($regex, $test, $matches) ){
    echo "比對成功！ 結果為: <br>";
    echo "<pre>";
    print_r($matches);
    echo "</pre>";
    for($i=0; $i<count($matches[0]); $i++){
        echo "{$matches[0][$i]}<br>";
    }
} else {
    echo "比對失敗";
}