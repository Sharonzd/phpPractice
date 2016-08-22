<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/16 11:08
 */
///require函数失败后,会给出一个致命的错误。
///include失败后,只是给出一个警告

///require不会考虑文件的扩展名,无论什么文件,通过require语句载入后,文件内的任何php命令都会被处理。
require('forrequire.php');
include 'forrequire.php';
//require_once('forrequire.php');   ///确保一个被包含的文件只被引入一次。无论是以什么方式引入的。
//include_once ('forrequire.php');


///require 或 include常用来做页眉 页脚。以方便的复用代码

///或者也可以使用php.ini中的   auto_prepend_file 和 auto_append_file来声明需要引入的文件。
///auto_prepend_file = "/xx/xxx/xxx.php"
///auto_append_file="/xx/xx/xxx.php"echo

///如果是apache服务器,可以对单个目录进行不同配置选项的修改。  在该目录中创建一个名为.htaccess的文件
///  php_value auto_prepend_file "/xx/xx/xxx.php"
///  php_value auto_append_file "xx/xx/xxx.php"

echo '-----------------------函数名称不区分大小写,变量名称区分大小写-------------------------'."<br>";
function test(){
    echo 'test'."<br>";
}
Test();  //即便这样也能调用成功

echo '-----------------------可变函数-------------------------'."<br>";
function name1(){
    echo 'name1'."<br>";
}
function name2(){
    echo 'name2'."<br>";
}
$name = 'name2';
$name();  ///php可以去处保存在$name中的值,并且调用该函数


echo '-----------------------函数的参数-------------------------'."<br>";
///第一个 参数是必须的,后三个参数是可选的,因为已经定义了默认值
function create_table($data,$border=1,$padding=4,$spacing=4){
    echo ''."<br>";
}
///可以声明能够接收可变参数数量的函数
function test_args(){
    echo func_num_args()."<br>";  //返回接收的参数的个数,
    $args = func_get_args();    //返回接收的参数的数组
    foreach($args as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
    echo func_get_arg(1);   //返回指定索引的参数
}

test_args('a','b','c');


echo '<br>-----------------------作用域-------------------------'."<br>";
$name = 2;
echo $name."<br>";
unset($name);   //unset变量。手动删除
echo $name."<br>";

///require 和 include 不影响变量作用域,相当于直接把一堆代码搬过来,该怎样就怎样

function fn(){
    global $var;  //使用global可以在函数内部创建具有全局作用域的变量
    $var = 123;
}
fn();  //调用fn后,函数里面的代码才会执行,$var也才会被创建未全局的变量。   函数在哪里声明不重要,重要的是在哪里调用并执行
echo $var."<br>";

echo '-----------------------参数的引用传递和值传递-------------------------'."<br>";
function increment(&$value,$amount = 1){
    $value += $amount;
}

echo '-----------------------递归-------------------------'."<br>";
//使用递归将一个字符串颠倒
function reverse_r($str){
    if(strlen($str)>0){
        reverse_r(substr($str,1));
    }
    echo substr($str,0,1);
    echo '<br> reverse_r called'."<br>";
    return;
}
function reverse_i($str){
    for($i = 1;$i<=strlen($str);$i++){
        echo substr($str,-$i,1);
    }
    echo '<br> reverse_i called'."<br>";
    return;
}
reverse_r('Hello');  //函数被调用六次
echo "<br>";
reverse_i('Hello');  //函数被调用一次