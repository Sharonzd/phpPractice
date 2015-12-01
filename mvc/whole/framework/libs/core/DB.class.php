<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 11:22
 * 工厂模式,对其他类的实例化
 */
class DB{ //类名在php里面是一个全局变量
    public static $db;   //静态属性使用 DB::$db调用，不需要再实例化
    /**
     * 初始化：实例化
    */
    public static function init($dbtype,$config){
        self::$db = new $dbtype;
        self::$db -> connect($config);
    }
    /**
     * 静态方法，使用实例化的数据库操作类，去执行其的query方法
    */
    public static function query($sql){
        return self::$db->query($sql);
    }

    public static function findAll($sql){
        $query = self::$db->query($sql);
        return self::$db->findAll($query);
    }

    public static function findOne($sql){

    }

    public static function findResult($sql,$row=0,$field = 0){
        $query = self::$db->query($sql);
    }
}