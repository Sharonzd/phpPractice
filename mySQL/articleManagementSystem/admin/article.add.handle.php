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
if(!(isset($_POST['title'])&&(!empty($_POST['title'])))){
    echo "<script>alert('标题不能为空');window.location.href='article.add.php'</script>";
}
$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

$insertsql = "insert into article(title,author,description,content,dateline) values ('$title','$author','$description','$content',$dateline)";
//echo $insertsql;
if(mysqli_query($con,$insertsql)){
    echo "<script>alert('发布成功');window.location.href='article.add.php'</script>";
}else{
    echo "<script>alert('发布失败');'</script>";
};