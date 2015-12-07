<?php
/**
 * Created by PhpStorm.
 * User: Sharon_zd
 * Date: 2015/12/8 0008
 * Time: 2:22
 */
class adminModel{
//    定义表名
public $_table='admin';
//    通过用户名取得用户信息
function findOne_by_username($username){
    $sql = "select * from $this-> _table where username = $username";
}
}