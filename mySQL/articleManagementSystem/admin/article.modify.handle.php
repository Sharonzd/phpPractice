<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/30
 * Time: 16:22
 */
require_once('../connect.php');
print_r($_POST);   //打印出来通过post提交过来的数据
//把传递过来的信息校验并入库

$id=$_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

$updatesql = "update article set title='$title',author='$author',description='$description',content='$content',dateline='$dateline' where id=$id";
echo $updatesql;
if(mysqli_query($con,$updatesql)){
    echo "<script>alert('修改成功');window.location.href='article.modify.php'</script>";
}else{
    echo "<script>alert('修改失败');'</script>";
};