<?php
/**
 * Created by PhpStorm.
 * User: Sharon_zd
 * Date: 2015/12/8 0008
 * Time: 2:22
 */
class adminModel{
//    �������
public $_table='admin';
//    ͨ���û���ȡ���û���Ϣ
function findOne_by_username($username){
    $sql = "select * from $this-> _table where username = $username";
}
}