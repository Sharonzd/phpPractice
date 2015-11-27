<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/26
 * Time: 15:45
 *
 * 将控制器、模型、视图的实例化及调用抽象成方法
 */
function C($name, $method)
{   //controller规范上，其method不该有参数，所以可以抽象
//        require_once('libs/Controller/testController.class.php');
    require_once('libs/Controller/' . $name . 'Controller.class.php');   //将name抽象出来
//        $testController = new testController();   //实例化一个控制器对象
//        $testController -> show();				//使用它的方法
    eval('$obj = new ' . $name . 'Controller();$obj -> ' . $method . '();');  //将执行代码用字符串拼出来，然后用eval执行

//        eval()函数调用简单，但是不安全, 应该如下
//    $controller = $name . 'Controller';
//    $obj = new $controller();
//    $obj->$method();
}

function M($name)
{
    require_once('libs/Model/' . $name . 'Model.class.php');
    eval('$obj = new ' . $name . 'Model();');
    return $obj;

//    eval()函数简单但是不安全，应该如下
//    $model = $name.'Model';
//    $obj = new $model;
}

function V($name)
{
    require_once('libs/View/'.$name.'View.class.php');
    eval('$obj = new '.$name.'View();');
    return $obj;
}

function daddslashes($str){
//    get_magic_quotes_gpc判断当前魔法符号(自动转义)的打开状态，打开的时候返回true。
//    addslashes是php的内置函数,对字符串的单引号等特殊符号进行转义
//    打开的时候直接返回$str，否则使用addslashes来转移之后再返回
    return (!get_magic_quotes_gpc())?addslashes($str):$str;
}