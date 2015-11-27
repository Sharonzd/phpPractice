<?php
/***
第一步 浏览者 -> 调用控制器，对它发出指令（实例化一个控制器对象，并使用它的方法）
第二步 控制器 -> 按指令选取一个合适的模型
第三步 模型 -> 按控制器指令取相应的数据
第四步 控制器 -> 按指令选取相应视图
第无不 视图 -> 把第三步取到的数据展现出来
 ***/
////include和require_once的作用一样都是引入文件，
///但是include引入的文件如果有误，则是给出警告，require_once会报错，更严格
//require_once('libs/Controller/testController.class.php');
//require_once('libs/Model/testModel.class.php');
//require_once('libs/View/testView.class.php');
//$testController = new testController();   //实例化一个控制器对象
//$testController -> show();				//使用它的方法


/** 入口文件的改造*/
//url形式  index.php?controller=控制器名&method=方法名
require_once('function.php');
//$_GET为php获取参数的方法，注意安全的话还需要用转义方法过滤,注重严谨性的话可以要求其名称范围

$controllerAllow = array('test','index');
$methodAllow = array('test','index','show');

$controller = in_array($_GET['controller'],$controllerAllow)?daddslashes($_GET['controller']):'index';
$method = in_array($_GET['method'],$methodAllow)?daddslashes($_GET['method']):'index';
C($controller, $method);
