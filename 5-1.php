<?php
$a = 5;
if ($a > 0) echo '$a是正數';

echo "<hr>";

if ($a > 0) {
    echo '$a大於0';
}

echo "<hr>";

$a = -5;
if ($a > 0) {
    echo '$a是正數';
} else {
    echo '$a是負數';
}

echo "<hr>";

//多向選擇 if … else if … else
$score = 85;
if ($score >= 60 && $score < 70) {
    echo '丙等';
} elseif ($score >= 70 && $score < 80) {
    echo '乙等';
} elseif ($score >= 80 && $score < 90) {
    echo '甲等';
} elseif ($score >= 90 && $score <= 100) {
    echo '優等';
} else {
    echo '不及格';
}

echo "<hr>";

//switch 條件控制
$direction = "南";
switch ($direction) {
    case '東':
        echo "我要往東走";
        break;
    case '南':
        echo "我要往南走";
        break;
    case '西':
        echo "我要往西走";
        break;
    case '北':
        echo "我要往北走";
        break;
    default:
        echo "我不知道要往哪裡走";
}
