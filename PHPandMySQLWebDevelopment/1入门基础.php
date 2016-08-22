header(“Content-Type: text/html; charset=gb2312");
<?php

/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 16/8/11
 * Time: 17:22
 */
/*可变变量*/
$varname = 'tiregty';
$$varname = 5;
echo isset($tiregty);  // 1
echo "<br>";
echo "<br>";

/*声明和使用常量*/
define('TIREPRICE',100);
echo TIREPRICE;
echo "<br>";
echo "<br>";

/*超级全局变量*/
/*
 *  $GLOBALS;
 * 所有全局变量的数组,包括超级全局变量
 * */
echo '-----------------------$GLOBAL-------------------------'."<br>";
foreach ($GLOBALS as $key => $current){
    echo $key." - ".$current."<br>";
}
echo "<br>";
/*
 *_GET - Array
_POST - Array
_COOKIE - Array
_FILES - Array
GLOBALS - Array
varname - tiregty
tiregty - 5     //在此刻,current被赋值为了5,所以下面的current值也是5
current - 5
key - current   //最后1个key,就是最后一个不包括自身的全局变量,就是current

由此可见,foreach中用到的变量也是全局变量
 *
 * */


/*Q1    key 和 current到底是不是全局变量*/

echo "$key"."<br>";
echo $current."<br>";

echo '----------------$_SERVER----------------'."<br>";
foreach ($_SERVER as $key => $value){
    echo $key.'    -----     '.$value."<br>";
}
echo "<br>";

echo '-----------------------$_POST-------------------------'."<br>";
foreach ($_POST as $key => $value){
    echo $key."   ---   ".$value."<br>";

}

echo '-----------------------$_GET-------------------------'."<br>";
foreach ($_GET as $key => $value) {
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------$_COOKIE-------------------------'."<br>";
foreach ($_COOKIE as $key => $value) {
    
}

echo '-----------------------$_FILES-------------------------'."<br>";
foreach($_FILES as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------$_ENV-------------------------'."<br>";
foreach($_ENV as $key => $value){
    echo $key."   ---   ".$value."<br>";
}
echo "<br>";

echo '-----------------------$_REQUEST 包括GET,POST,COOKIE,SERVER的HTTP_COOKIE-------------------------'."<br>";
foreach($_REQUEST as $key => $value){
    echo $key."   ---   ".$value."<br>";
}
echo "<br>";

/*Q3 为什么session 在foreach无效*/
echo '-----------------------$_SESSION-------------------------'."<br>";
foreach($_SESSION as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo "<br>";

/*表达式的值即为右边的值*/
echo $a=1;
echo "<br>";

$a = (57/0);
$b = @(57/0);   ///错误抑制操作符,警告被抑制
//

echo $php_errormsg;

echo "<br>";
echo '-----------------------执行操作符 ``-------------------------'."<br>";
$out = `ls -la`;
echo '<pre> '.$out. '</pre>';

echo '-----------------------测试和设置变量类型-------------------------'."<br>";
$a=56;
echo gettype($a)."<br>";
settype($a,'double');
echo gettype($a)."<br>";


echo gettype(is_array($a))."<br>";  ////返回的是boolean值    echo出来的话,true为1,false直接不显示

echo "数组".is_array($a)."<br>";

echo "浮点 ".is_double($a)."<br>";
echo "浮点 ".is_float($a)."<br>";
echo "浮点 ".is_real($a)."<br>";

echo "整数 ".is_long($a)."<br>";
echo "整数 ".is_int($a)."<br>";
echo "整数 ".is_integer($a)."<br>";

echo "字符串 ".is_string($a)."<br>";
echo "布尔值 ".is_bool($a)."<br>";

echo "对象 ".is_object($a)."<br>";
echo "资源 ".is_resource($a)."<br>";
echo "null ".is_null($a)."<br>";
echo "标量（整数/布尔值/字符串/浮点数） ".is_scalar($a)."<br>";
echo "数字/数字字符串 ".is_numeric($a)."<br>";
echo "函数 ".is_callable(function(){})."<br>";

echo '-----------------------测试变量状态-------------------------'."<br>";
/*isset取决于变量在不在*/
echo isset($a)."<br>";
unset($a);
echo isset($a)."<br>";

/* Q3 empty要在哪种情况下才为false*/

/*empty取决于变量的值,即便$a未定义,也会返回1*/
$a=null;
echo empty($a)."<br>";


$int = 0x123;   //16进制
echo gettype($int)."<br>";
echo gettype(floatval($int))."<br>";
echo gettype(strval($int))."<br>";
/* Q4 在要转换的变量为字符串时指定转换的进制基数   来个例子?  */
echo gettype(intval($int,2))."<br>";
echo $int."<br>";   //

/*循环
 * break 从循环体后面的第一条语句处开始执行
 * continue 跳到下一次循环
 * exit 结束整个php脚本的执行
 * */

/* Q5 举个例子??? */
$num_array = array(1,2,3,4,5,6,7);
for($i=0;$i<=6;$i++){
    echo $num_array[$i]."<br>";
}

echo '-----------------------可替换的控制结构语法-------------------------'."<br>";
if($a === 0){
    echo '111';
}
if($a === 0):
    echo '111';
endif;




declare(ticks = 3){

}

?>
