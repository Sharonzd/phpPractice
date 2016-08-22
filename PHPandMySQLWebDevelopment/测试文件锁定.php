<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/12 19:23
 */


$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

$path = "$DOCUMENT_ROOT/../phpdata/orders.txt";
$lockpath = "$DOCUMENT_ROOT/../phpdata/lockfile.txt";

$fp = fopen($lockpath,'r');
flock($fp,LOCK_SH);  ///读锁
while (!feof($fp)){    //读文件
    $order = fgets($fp,999);
    echo $order."<br>";
}
flock($fp,LOCK_UN); //释放锁
fclose($fp);