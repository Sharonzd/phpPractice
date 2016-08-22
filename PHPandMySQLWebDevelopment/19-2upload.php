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
}


?>

</body>
</html>
