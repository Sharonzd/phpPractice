<html>
<head>
    <title>browse directories</title>
</head>
<body>
<h1>browsing</h1>

<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/25 17:39
 */
$path = '/Library/WebServer/uploads';  ///必须要写出完整路径,but why?
$dir=opendir($path);  //打开浏览的目录,返回一个目录句柄

echo "upload dir is $path"."<br>";
echo "dir list <br> <ul>";


//每调用一次readdir,就会读取一次文件,目录指针就会后移。所以不要在判断语句里过多的使用 readdir($dir)。 而应该对变量进行判断
//从目录中读取文件。当目录中没有可读的文件时,返回false。当读到一个名为0的文件时,返回的也是false'. 所以需要测试返回值是否全等于false。
//判断NULL是因为当目录不存在时,返回为NULL,$false!==NULL恒成立。

while ((NULL !== ($file = readdir($dir)))  && $file !== false){  //readdir读目录
    echo "read successful<br>";
    if($file != "." && $file != "..") //过滤特殊文件夹
    {
        echo "<li>$file</li>";
    }
}
echo "</ul>";
rewinddir($dir); //将目录指针回复到开始
closedir($dir); //关闭该目录

?>

<h1>browsing again</h1>
<?php
$dir2 = dir($path);  //php提供的dir类。具有handle和path属性
echo "handle is $dir2->handle"."<br>";  //Resource id #4
echo 'upload dir is '.$dir2->path."<br>"; //   /Library/WebServer/Documents/uploads
echo 'dir list:'."<br> <ul>";
while(false !== ($file2=$dir2->read())){  //$dir2->read() 读取目录
    echo "read successful<br>";
    if($file2 != "." && $file2 != ".."){
        echo "<li>$file2</li>";
    }
}
echo "</ul>";
$dir2->rewind();  //将目录指针恢复到开始
$dir2->close();

?>

<h1>browsing third</h1>
<?php
echo '-----------------------scandir将文件夹名称按字母表顺序保存在一个有序数组。-------------------------'."<br>";
$file3 = scandir($path);
$file4 = scandir($path,1);
echo "uploading dir is $path <br>";
echo "list dir in alpha order asc:";

foreach ($file3 as $file){
    if($file != "." && $file != ".."){
        echo "<li>$file</li>";
    }
}
echo "</ul>";
echo "upload dir is $path<br>";
echo "list dir in alpha order desc:";

foreach ($file4 as $file){
    if($file != "." && $file !=".."){
        echo "<li>$file</li>";
    }
}
echo "</ul>";

echo '-----------------------返回路径的目录部分-------------------------'."<br>";
echo dirname($path)."<br>";
echo '-----------------------返回路径的文件名称部分-------------------------'."<br>";
echo basename($path)."<br>";
echo '-----------------------返回磁盘/该目录所在文件系统上的空余空间-------------------------'."<br>";
echo disk_free_space($path);

echo '-----------------------创建目录-------------------------'."<br>";
echo umask(); //不带参数,会返回当前的umask码    不适用于windows
$oldumask = umask(0);  //所以重置umask,返回以前的umask 并保存下来
mkdir("/tmp/testing",0777);   ///该设置的权限值会与umask『与』,然后得到真正的权限值
umask($oldumask);  //恢复之前的umask
echo '-----------------------删除目录-------------------------'."<br>";
rmdir("/tmp/test");  //要删除的目录必须为空目录


?>

</body>
</html>

