<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/30
 * Time: 16:22
 */
require_once('../connect.php');
$id = $_GET["id"];
$deletesql = "delete from article where id=$id";
echo $deletesql;
if(mysqli_query($con,$deletesql)){
    echo "<script>alert('删除成功');window.location.href='article.manage.php';</script>";
}else{
    echo "<script>alert('修改失败');'</script>";
};