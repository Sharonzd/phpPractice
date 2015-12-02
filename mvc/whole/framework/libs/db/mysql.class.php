<?php
/** php操作mysql类的封装
 * 减少代码冗余，提高开发速度。
 * 降低编程错误
 * 便于维护升级
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 11:25
 */
class mysql{  //类是全局的

    /**
     * 报错函数
    */
    function err($error){
        die("对不起，您的操作有误，错误原因为：".$error);  //输出信息并退出
    }
    /**
     * @param string $dbhost 主机名
     * @param string $dbuser 用户名
     * @param string $dbpsw  密码
     * @param string $dbname 数据库名
     * @param string $dbcharset 字符集/编码
     * @return bool  连接成功或不成功
     */
    function connect($config){
        extract($config);  //提取变量，数组中的每个元素，键用于变量名，键值用于变量值。提取出来后就直接成了变量了，可以直接调用
        if(!($con = mysql_connect($dbhost,$dbuser,$dbpsw))){
            $this ->err(mysqli_error($con));
        }
        if(!mysqli_select_db($con,$dbname)){
            $this -> err(mysqli_error($con));
        }
        mysqli_query($con,"set names ".$dbcharset);
    }

    function query($con,$sql){
        if(!($query = mysqli_query($con,$sql))){
            $this->err($sql."<br/>".mysqli_error($con));
        }
    }
}