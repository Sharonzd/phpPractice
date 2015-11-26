<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>测试页面</title>
<body>
<h1>
<?php
$value = time();
//在这里设置一个名为test的Cookie
setcookie('test2',$value,0,'/');
print_r($_COOKIE);
if (isset($_COOKIE['test'])) {
    print_r($_COOKIE['test']);
    echo 'success';
}
var_dump($value);
//setcookie('test','',time()-1);
?>
</h1>
</body>
</html>