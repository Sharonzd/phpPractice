<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/30
 * Time: 16:07
 */
require_once('config.php');
if(!($con = mysql_connect(HOST,USERNAME,PASSWORD))){
    echo mysql_error();
};
if(!mysql_select_db('test')){
    echo mysql_error();
};
if(!mysql_query('set names utf8')){
    echo mysql_error();
};
