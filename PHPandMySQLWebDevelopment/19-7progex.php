

<?php
/**
 * File:  使用命令来操作目录。    缺点是代码不可移植
 * Auther: zhoudan03
 * Datetime: 16/8/26 14:21
 */

//进入文件夹
chdir('/Library/WebServer/uploads/');

echo '----------------------使用exec函数执行命令-------------------------'."<br>";
echo "<pre>";
echo exec('ls -la',$result, $return_value)."\n"; //函数返回命令结果的最后一行。
echo $return_value."<br>";   //return_value会返回一个返回代码
//exec('dir',$result);  //windows
//result返回字符串的数组
foreach ($result as $line) {
    echo "$line\n";
}
echo "</pre>";
echo "<br><hr><br>";

echo '-----------------------使用passthru-------------------------'."<br>";
echo "<pre>";
//函数无返回值,直接将输出显示到浏览器。
passthru('ls -la');
//windows
//passthru('dir');
echo "</pre>";
echo "<br><hr><br>";

echo '-----------------------使用system-------------------------'."<br>";
echo "<pre>";
//函数返回输出的最后一行, 将输出回显到浏览器。每一行的输出向后对齐????question
$result = system('ls -la');
//windows
//$result = system('dir');
echo "</pre>";

echo '-----------------------使用执行引号-------------------------'."<br>";
echo "<pre>";
//以字符串形式返回执行结果
$result = `ls -la`;
//windows
//$result = `dir`;
echo $result;
echo "</pre>";

echo '-----------------------启动外部进程,并可以在这些进程之间传递数据------------------------'."<br>";
//popen();
//proc_open();
//proc_close();

echo '-----------------------阻止用户执行命令,escapeshellcmdz整理任何要传递给shell命令的参数-------------------------'."<br>";
system(escapeshellcmd($command));

echo '-----------------------获取环境(运行PHP的服务器)变量值-------------------------'."<br>";
echo getenv("HTTP_REFERER")."<br>";  //返回用户来到当前页之前的上一页面url
echo '-----------------------设置环境变量值-------------------------'."<br>";
$home = "/home/nobody";
//putenv("HOME=$home");


