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

echo "<br>";
//检验日期是否有效
echo checkdate(2,29,2008);

echo "<br>";
///格式化时间戳
echo strftime("%A");

echo "<br>";
//使用PHP根据某人的生日计算年龄
$day = 18;
$month = 9;
$year = 1972;
$bdayunix = mktime(0,0,0,$month,$day,$year);
$nowunix = time();
$ageunix  = $nowunix - $bdayunix;
$age = floor($ageunix/(365*24*60*60));
echo "age is $age";

echo "<br>";
///使用MySQL计算某人基于生日的年龄
$bdayISO  = date("c",mktime(0,0,0,$month,$day,$year));
echo "<br>";
echo $bdayISO;
$db = mysqli_connect('localhost','root','');
//mySQL中查询日期的方式：select
$res = mysqli_query($db,"select datediff(now(),'$bdayISO')");
$age = mysqli_fetch_array($res);
echo "age is ".floor($age[0]/365.25);

echo "<br>";
//使用微秒. 返回浮点数的时间戳
echo microtime(true);
echo "<br>";
echo number_format(microtime(true),10,'.','');
//number_format ($number , $decimals = 0 , $dec_point = '.' , $thousands_sep = ',' )

echo "<br>";
//使用日历函数
echo jdtojulian(gregoriantojd(9,18,1582));

