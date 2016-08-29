<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/26 17:06
 */

//获取url
$url = $_REQUEST['url'];

$email = $_REQUEST['email'];

//返回包含url不同部分的相关数组。
$url=parse_url($url);
$host = $url['host'];
//gethostbyname获取主机的ip地址
if(!($ip=gethostbyname($host))){
    echo 'host for url does not have valid ip';
    exit;
}
//gethostbyaddr根据IP获取host
if(!($host2=gethostbyaddr($ip))){
    echo 'host for this ip does not valid';
    exit;
}
//获得的主机与开始的主机不一样,意味着网站正在使用一个虚拟主机服务,在服务中,一个主机和IP地址具有多个域名
echo $host.'<br>  '.$host2."<br>";

echo 'host is at IP '."$ip <br>";
$email = explode('@',$email);
$emailhost = $email[1];

//检查是否有邮件可以到达的确切地方。返回一个邮件地址的一组邮件交换记录,该地址由数组$mxhostarr提供
if (!dns_get_mx($emailhost,$mxhostsarr)){
    echo 'email address is not at valid host';
}
echo 'email is deliverd via: ';
foreach ($mxhostsarr as $mx) {
    echo "$mx; ";
}
echo '<br>All submitted details are ok.<br>';
echo "Thank you for submitting your site.<br>"."it will be visited by one of our staff members soon.";

