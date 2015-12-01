<?php
/**启动引擎程序
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 18:00
 */
$currentdir = dirname(__FILE__);  //获取当前框架的目录地址并保存。
include_once($currentdir . '/include.list.php');  //将当前目录下的清单文件include进来
foreach($paths as $path){
    include_once($currentdir.'/'.$path);
}

class PC{
    public static $controller;
    public static $method;
    private static $config;
    private static function init_db(){
        DB::init('mysql',self::$config['dbconfig']);
    }
    private static function init_view(){
        VIEW::init('Smarty',self::$config['viewconfig']);
    }
    private static function init_controller(){
        self::$method = isset($_GET['controller'])?addslashes():true;
    }
    public static function run($config){
        self::$config = $config;
        self::init_db();
        self::init_view();
    }
}