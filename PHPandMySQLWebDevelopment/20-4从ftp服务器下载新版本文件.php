<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/26 18:51
 */


//  连接失败。待test

$host = 'ftp.cs.rmit.edu.au';
$user = 'anonymous';
$password = 'me@example.com';
$remotefile = '/pub/tsg/teraterm/ttssh14.zip';
$localfile = '/tmp/writable/ttssh14.zip';

//1. 连接远程ftp服务器。不指定端口则默认21
$conn = ftp_connect($host);
if(!$conn){
    echo 'Error:could not connect to fpt server <br/>';
    exit;
}
echo 'Connected to $host. <br>';

//2. 登录到ftp服务器
$result = @ftp_login($conn,$user,$password);
if (!$result){
    echo "Error: could not log on as $user <br>";
    ftp_quit($conn);
    exit;
}
echo "Logged in as $user <br>";
echo "checking file time ... <br>";

//3. 检查文件更新时间
if(file_exists($localfile)){
    $localtime = filemtime($localfile);
    echo "local file last update ";
    echo date('G:i j-M-Y', $localtime);
    echo "<br>";
} else {
    $localtime= 0;  //如果文件不存在,设置该时间为0,这样此文件比任何远程文件的修改时间都要老。
}
$remotetime = ftp_mdtm($conn,$remotefile);  //获得远程文件修改时间
if(!($remotetime>=0)){
    echo 'cant access remote file time';
    $remotetime = $localtime + 1;  //手动设置,使得$remotetime 比$localtime 新,确保文件将会被下载
}else{
    echo "remote file last updated ";
    echo date('G:i j-M-Y',$remotetime);
    echo "<br>";
}
if(!($remotetime>$localtime)){
    echo 'local copy is up to date';
    exit;
}

//4. 下载文件
echo "getting file from server...";
set_time_limit(90);//重新设置脚本所允许的最大可执行时间、避免超时
$fp = fopen($localfile,'w');//打开本地文件准备读写
echo ftp_size($conn,$remotefile);//显示服务器上一个文件的大小。可用来估算传输可能需要的时间
$list = ftp_nlist($conn, dirname($remotefile));//获得并显示ftp服务器特定目录上的文件列表
foreach ($list as $filename) {
    echo $filename."<br>";
}
if (!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY)){//下载文件并存在本地文件中
//    ftp_get($conn,"xxx/xxx",$remotefile,FTP_ASCII})  //fget不用打开文件,直接传递文件路径即可
//    ftp_fput(ftp_connection, remote_path, localfile_fp, mode);
//    ftp_put(ftp_connection,remotefile,localfile_path,mode);
    echo 'Error: could not download file';
    fclose($fp);
    ftp_quit($conn);
    exit;
}
fclose($fp);
echo "file download successfully";


