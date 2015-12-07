<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/7
 * Time: 18:10
 */
header("Content-type:text/html;charset=utf-8");  //设置字符集防止乱码
session_start();   //要使用session，在此启动
require_once("config.php");   //配置文件
require_once("framework/pc.php");  //引入微型框架
PC::run($config);  //传递配置数组，启动引擎