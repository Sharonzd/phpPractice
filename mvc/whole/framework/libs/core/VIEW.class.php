<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 11:41
 *
 * 视图引擎工厂类
 */
class VIEW{
    public static $view;
    /**
     * 初始化
     * $viewtype  视图引擎类的类型
     * $config    配置
    */
    public static function init($viewtype,$config){
        self::$view = new $viewtype();

        /**以smarty模板为例
         * $smarty=new Smarty();  //实例化smarty
         * $smarty->left_delimiter = $config["left_delimiter"];   //左定界符
         * $smarty->right_delimiter = $config["right_delimiter"];   //右定界符
         * $smarty->template_dir = $config["template_dir"];   //html模板的位置
         * $smarty->compile_dir = $config["compile_dir"];  //模板编译生成的文件
         * $smarty->cache_dir = $config["cache_dir"];  //缓存
        */
        foreach($config as $key=>$value){  //将配置项赋给$view
            self::$view->$key = $value;
        }
    }
    /**
     * 分配数据
    */
    public static function assign($data){
        foreach($data as $key=>$value){
            self::$view->assign($key, $value);
        }
    }
    /**
     * 显示视图
    */
    public static function display($template){
        self::$view->display($template);
    }
}