<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 11:22
 * 工厂模式,对其他类的实例化
 *
 * 此为DB引擎的工厂类
 */
class DB{ //类名在php里面是一个全局变量 DB::$db,DB::query(),DB::findAll($sql)
//  静态属性：保存将来对数据库操作类实例化后的对象
    public static $db;   //静态属性使用 DB::$db调用，不需要再实例化；静态方法 DB::方法()
    /**
     * 静态方法。初始化：实例化
     * $dbtype:需要实例化的数据库操作类的类型
     * $config:数据库的配置信息
    */
    public static function init($dbtype,$config){
        self::$db = new $dbtype;  //实例化，保存在$db中
        self::$db -> connect($config);  //使用对象的连接方法，将config传递给connect（对于所用的mysql即mysql操作类的connect方法）
    }
//    依次把数据库的操作方法变为工厂类的方法
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
        $query = self::$db->query($sql);
        return self::$db->findOne($query);
    }

    public static function findResult($sql,$row=0,$field = 0){
        $query = self::$db->query($sql);
        return self::$db->findResult($query,$row,$field);
    }

    public static function insert($table,$arr){
        return self::$db->insert($table,$arr);
    }

    public static function update($table,$arr,$where){
        return self::$db->update($table,$arr,$where);
    }

    public static function delete($table,$where){
        return self::$db->delete($table,$where);
    }
}