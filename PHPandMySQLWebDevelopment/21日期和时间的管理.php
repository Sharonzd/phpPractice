<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/28 12:44
 */

//将时间和日期转变为unix时间戳
echo mktime();  //没有参数将返回当前时间的unix时间戳
//is_dst会根据所运行的系统来确定是否是夏令时,可能导致意想不到的结果
echo "<br>";

echo mktime(12,0,0);  //中午12点时间
echo "<br>";
echo "<br>";

//不需要任何参数,返回当前日期和时间的unix时间戳
echo time();

echo "<br>";

//date需要参数来表示格式。可选参数为一个unix时间戳。没有则默认当前时间
echo date('U');

echo "<br>";
print_r(getdate());