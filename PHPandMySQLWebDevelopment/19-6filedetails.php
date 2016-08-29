<html>
<head>
    <title>file detail</title>
</head>
<body>


<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/26 11:02
 */
$path = "/Library/WebServer/uploads/";
//echo gettype($file);
$filename  = basename($path);
echo "file name: ".$filename."<br>";
$dirname = dirname($path);
echo "dir name: ".$dirname."<br>";

echo "<h1>details of file: $filename <br></h1>";

$file = $dirname.'/'.$filename;
echo $file;

echo "<h2>file data</h2>";
//返回文件最近被访问的时间戳。date格式化时间戳
echo "file last accessed: ".date('j F Y H:i',fileatime($file))."<br>";
//返回文件最近被修改的时间戳
echo "file last modified: ".date('j F Y H:i',filemtime($file))."<br>";
//fileowner返回文件的用户标识 uid,  posix_getpwuid将用户标识转换为容易理解的名字
$user = posix_getpwuid(fileowner($file));
echo "file owner: ".$user['name']."<br>";
//filegroup返回文件的组标识gid, posix_getgrgid转换为容易理解的名字
$group = posix_getgrgid(filegroup($file));
echo "file group: ".$group['name']."<br>";
//fileperms返回文件权限码,decoct转换为8进制
echo "file permissions: ".decoct(fileperms($file))."<br>";
//返回文件类型信息: fifo、char, dir, block, link , file, unknown
echo "file type: ".filetype($file).'<br>';
//返回文件大小,以字节计算
echo "file size: ".filesize($file).'bytes <br>';
echo "<h2> file test </h2>";

//检测文件的指定属性,并返回true or false
echo "is_dir: ".(is_dir($file)?'true':'false')."<br>";
echo "is_executable: ".(is_executable($file)?'true':'false')."<br>";
echo "is_file: ".((is_file($file))?'true':'false')."<br>";
echo "is_link: ".((is_link($file))?'true':'false')."<br>";
echo "is_readable: ".((is_readable($file))?'true':'false')."<br>";
echo "is_writable: ".((is_writable($file))?'true':'false')."<br>";

echo '----------------------返回文件信息数组。--------------------------'."<br>";
foreach(stat($file) as $key => $value){
    echo $key."   ---   ".$value."<br>";
}
echo '-----------------------仅用于符号链接文件,返回文件信息数组--------------------------'."<br>";
foreach(lstat($file) as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

//所有文件状态函数的运行都很浪费时间。 所以结果将被缓存起来,如果要在变化之前或变化之后检查信息,需要调用函数
clearstatcache();  //清空缓存

chgrp($file,0); //修改文件的组。只能用于将组改成该用户所在的组,root用户除外
//chmod($file,0777); //修改文件的权限.??  question 怎样获得权限
//chown($file,'root'); //修改文件的所有者.通常没有权限,只能以管理员的身份来运行该脚本

//创建文件。默认创建在当前文件夹
touch('test.txt');
///复制文件。
copy('test.txt','/Library/WebServer/phpdata/test.txt');
//重命名或者移动文件。
rename('test.txt','./../test/test2.txt');
//删除文件
unlink('/Library/WebServer/phpdata/test.txt');


?>
</body>
</html>





