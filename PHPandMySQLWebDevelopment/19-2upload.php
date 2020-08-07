<html>
<head><title>uploading...</title></head>
<body>
<h1>uploading...</h1>

<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/22 18:18
 */

//超级全局数组 $_FILES

//检查文件的错误码
if($_FILES['userfile']['error']>0){
    echo 'error!';
    switch ($_FILES['userfile']['error']){
        case 1:echo '错误1 UPLOAD_ERR_INI_SIZE 上传的文件大小超出了约定值';break;
        case 2:echo '错误2 UPLOAD_ERR_FROM_SIZE 上传的文件大小超出了HTML表单MAX_FILE_SIZE元素锁指定的最大值';break;
        case 3:echo "错误3 UPLOAD_ERR_PARTIAL 文件只被部分上传";break;
        case 4:echo "错误4 UPLOAD_ERR_NO_FILE 没有上传任何文件";break;
        case 6:echo "错误5 UPLOAD_NO_TMP_DIR 在php.ini中没有指定临时目录";break;
        case 7:echo "错误7 UPLOAD_ERR_CANT_WRITE 写入磁盘失败";break;
    }
    exit;
}

//检查文件的MINE类型.由用户浏览器对文件扩展名判断,并传给服务器（可能是虚假的）
echo $_FILES['userfile']['type']."<br>";
if($_FILES['userfile']['type'] != 'text/plain'){
    echo 'error: file is not plain text';
    exit;
}

//想要换个文件夹来保存。路径需要完整,是相对整个系统而言的。确保文件夹是可以访问的。
$upfile = '/Library/WebServer/Documents/uploads/'.$_FILES['userfile']['name'];

/* 一些恶意的访问者可能会提供一个它自己的临时文件名称,并且使脚本认为这个文件就是上传的文件。
 * 由于许多文件上传脚本都会向用户显示所上传的文件内容,并且将其保存在可以载入该文件的地方,
 * 这可能导致人们能够访问只有web服务器才能访问的文件。如/etc/passwd
 * */
//检查要打开的文件是否已经真正被上传而且不是一个本地文件
if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
//    将上传的文件复制到包含目录中。目录不要是web文档树的结构中
    if(!move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
        echo 'could not move file to destination directory';
        exit;
    }
} else{
    echo 'error:possible file upload attack.Filename: '.$_FILES['userfile']['name'];
    exit;
}

echo 'File uploaded successfully<br><br>';

//打开文件,获取内容
$content  = file_get_contents($upfile);
//清除html、php标记
$content = strip_tags($content);
//保存该文件
file_put_contents($_FILES['userfile']['name'],$content);   /////???访问失败   可是明明权限是777了

echo 'preview of uploaded file contents: <br><hr>';
echo nl2br($content);
echo '<br><hr>'

?>

</body>
</html>
