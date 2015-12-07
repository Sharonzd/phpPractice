<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/7
 * Time: 18:38
 * 后台入口的控制器文件
 */
class adminController{
    public function login(){
        if($_POST){
//            进行登陆处理
//            登陆处理的业务逻辑放在admin auth
//            admin同表名的模型：从数据库里取用户信息
//            auth模型：进行用户信息的核对
        }

//        显示登陆界面
        VIEW::display('admin/login.html');
    }
}