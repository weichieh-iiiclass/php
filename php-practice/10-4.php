<?php

$regex = "/https:\/\/stickershop\.line-scdn\.net\/stickershop\/v1\/sticker\/([0-9]+)\/android\/sticker\.png/";
$test = 'background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/390390639/android/sticker.png;compress=true);
background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/390390643/android/sticker.png;compress=true);
background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/390390657/android/sticker.png;compress=true);';

if( preg_match_all($regex, $test, $matches) ){

    echo "<pre>";
    print_r($matches);
    echo "</pre>";

    echo "<hr>";

    for($i=0;$i<count($matches[0]); $i++){
        echo "照片連結為: <a href='{$matches[0][$i]}' target='_blank'>{$matches[0][$i]}</a> <br>";
        echo "照片代號為: {$matches[1][$i]} <br>";
        echo "<hr>";
    }
} else {
    echo '比對失敗';
}