<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/26 15:17
 */

echo '-----------------------从NASDAQ获得$symbol列表所给出股票的报价脚本-------------------------'."<br>";
$symbol = 'AMZN';
echo '<h1>stock quote for '.$symbol."</h1>";
$url = 'http://finance.yahoo.com/d/quotes.csv'.'?s='.$symbol.'&e=.csv&f=sl1d1t1c1ohgv';
//使用文件函数从url中读取信息(字符串)。返回指定url的web页面的所有内容,并将其保存在$content中
if(!($content = file_get_contents($url))){
    die('Failure to open '.$url);
}
echo $content."<br>";  //"AMZN",759.22,"8/25/2016","4:00pm",+1.97,756.00,760.56,754.74,1622992
//用explode函数,对它按照,分隔开成数组。使用list()对数组的前4个元素命名
list($symbol,$quotes,$date,$time) = explode(',',$content);
echo gettype($date)."<br>";
echo $date;
$date = trim($date,'"');  //使用trim去掉两端的"
echo gettype($date)."<br>";
echo $date;

$time = trim($time,'"');
echo $symbol." was last sold at ".$quotes." <br>";
echo "quote current as of ".$date." at ".$time."<br>";

echo 'this information retrieved from <br/> <a href="'.$url.'">'.$url."</a>";

echo "<br>";
//将用户参数转换为适合url的格式
$parameter = "i am a test paramter";
$encodedparameter = urlencode($parameter);
echo $encodedparameter;



