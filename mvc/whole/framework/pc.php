<?php
/**启动引擎程序
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 18:00
 */
$currentdir = dirname(__FILE__);  //获取当前框架的目录地址并保存。
include_once($currentdir . '/include.list.php');  //将当前目录下的清单文件include进来。
//include：包含，执行的时候没有找到文件会警告，但继续执行
//include_once：包含，如果已经包含的文件就不再包含，执行的时候没有找到文件会警告，但继续执行
//require：引用资源，如果资源没找到，会发生致命错误并终止执行
//require_once:引用，如果已经引用了就不再引用了，如果没找到资源，会报错终止执行。
foreach ($paths as $path) {   //将include里面的所有路径，加上根目录的路径，逐条include进来
    include_once($currentdir . '/' . $path);
}

class PC
{   //引擎类
    public static $controller;   //PC::controller  获取当前程序运行的控制器名称
    public static $method;
    private static $config;   //用来保存整个网站的
    private static function init_db()
    {    //初始化db引擎
        DB::init('mysql', self::$config['dbconfig']);   //使用db的工厂类的init方法
        //也可以把参数'mysql'存在config数组里面，会更加通用。
    }

    private static function init_view()
    {    //初始化视图引擎
        VIEW::init('Smarty', self::$config['viewconfig']);  //使用视图引擎的工厂类的init方法
    }

//    进首页的时候打一个网址就好了，不需要写明控制器，所以是给一个默认的控制器。
    private static function init_controller()
    {      //初始化控制器类
        self::$controller = isset($_GET['controller']) ? addslashes($_GET['controller']) : 'index';
    }

//    刚进来的时候可以不传方法，使用默认的方法。对数据库的一系列配置，
    private static function init_method()
    {
        self::$method = isset($_GET['method']) ? addslashes($_GET['method']) : 'index';
    }


    public static function run($config)
    {
        self::$config = $config;//将config保存起来
//        执行所有的初始化工作
        self::init_db();
        self::init_view();
        self::init_controller();
        self::init_method();
//        完成对控制器的实例化
        C(self::$controller,self::$method);
    }
}