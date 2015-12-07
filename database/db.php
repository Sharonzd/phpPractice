<?php
/**
 * Created by PhpStorm.
 * User: Sharon_zd
 * Date: 2015/11/27 0027
 * Time: 1:28
 */
header('Content-type:text/html;charset=utf-8');
if($con = mysql_connect('localhost','root','123')){
    echo '连接成功';
}