<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 18:26
 *
 * 分成两个数组，一个视图的配置，一个数据库的配置
 */

$config = array(
//    视图配置
    'viewconfig'=>array(
        'left_delimiter'=>'{',
        'right_delimiter'=>'}',
        'template_dir'=>'tpl',
        'compile_dir'=>'data/template_c'
    ),
//    数据库配置
    'dbconfig'=>array(
        'dbhost'=>'localhost',
        'dbuser'=>'root',
        'dbpsw'=>'',
        'dbname'=>'test',
        'dbcharset'=>'utf8'
    )
);
