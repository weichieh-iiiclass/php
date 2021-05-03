<?php

$arr = [];

$arr[0]="";
$arr[1]=0;
$arr[2]=false;
$arr[3]=10;
$arr[4]=NULL;

echo '$a[0] = "" ';
echo empty($arr[0]) ? '為空' : '不為空';

echo "<hr />";

echo '$a[1] = 0 ';
echo empty($arr[1]) ? '為空' : '不為空';

echo "<hr />";

echo '$a[2] = false ';
echo empty($arr[2]) ? '為空' : '不為空';

echo "<hr />";

echo '$a[3] = 10 ';
echo empty($arr[3]) ? '為空' : '不為空';

echo "<hr />";

echo '$a[4] = NULL  ';
echo empty($arr[4]) ? '為空' : '不為空';