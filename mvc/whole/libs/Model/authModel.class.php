<?php
/**
 * Created by PhpStorm.
 * User: Sharon_zd
 * Date: 2015/12/8 0008
 * Time: 2:25
 */
class authModel{
    private $auth="";
    public function loginsubmit(){
        if(empty($_POST['username'])){}
    }
    private function checkuser($username, $password){
        $adminobj = M('admin');
        $auth = $adminobj->findOne_by_username($username);
        if((!empty($_POST['username']))){}
    }
}