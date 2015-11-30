<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/27
 * Time: 10:44
 */
//mysql_方法已经被废弃，需要使用mysqli_方法，而这方法通常需要加入连接的参数
//设置文件头，防止页面乱码
header('Content-type:text/html;charset=utf-8');
function newline(){
    echo '<br>';
}
//if(function_exists('mysql_connect')){
//    echo '有mysql扩展';
//    newline();
//}
//if(function_exists('mysqli_connect')){
//    echo 'mysqli扩展';
//    newline();
//}
//if(function_exists('pdo_connect')){
//    echo 'pdo扩展';
//    newline();
//}
//if(function_exists('sybase_connect')){
//    echo 'sybase扩展';
//    newline();
//}
//if(function_exists('db2_connect')){
//    echo 'db2扩展';
//    newline();
//}
//if(function_exists('oracle_connect')){
//    echo 'oracle扩展';
//    newline();
//}
//if(function_exists('postgresql_connect')){
//    echo 'postgresql扩展';
//    newline();
//}
//if(function_exists('access_connect')){
//    echo 'access扩展  ';
//    newline();
//}
/*连接数据库*/
if($link = mysqli_connect('localhost','root','')){
    echo '连接成功';
}else{
    echo '连接失败';
}
newline();
if(mysqli_select_db($link,'test')){
    echo '选择数据库成功';
}else{
    echo '选择数据库失败';
}
newline();


/*设置连接的编码格式，防止数据乱码*/
mysqli_query($link,"set names 'utf8'");


//$link = mysqli_connect('localhost','root','') or die('数据库连接失败');
$sql = "insert into info(name,gender,age) values('嘿嘿嘿','女','25')";
if(mysqli_query($link,$sql)){
    echo '插入成功';
}else{
    echo mysqli_error($link);  //会跟踪错误地方
    echo '插入失败';
}

//查询后，返回一个资源句柄
$resource = mysqli_query($link,'select * from info');

//从资源句柄中取一行数据
//$row = mysqli_fetch_row($resource);
//var_dump($row);

//通过遍历打印一个数组
$data = array();
//while($row2=mysqli_fetch_array($resource)){
//    $data[] = $row2;
//}
//var_dump($data);

$obj = mysqli_fetch_object($resource);
echo $obj->name;
//print_r($obj);
//var_dump($obj);

//删除数据
if(mysqli_query($link,'delete from info WHERE id in (5,6,7,8,9,10)')){
    echo '删除成功';
}else{
    echo '删除失败';
}

mysqli_close($link);