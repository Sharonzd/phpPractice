<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>测试页面</title>
<body>
<h1>
<?php 
echo "hello world";
print_r($_COOKIE);
//setcookie('test', time());   //设置cookie
//ob_start();
//print_r($_COOKIE);  //从浏览器发回的cookie会自动存储在$_COOKIE的全局变量之中。
//echo $_COOKIE['test'];  //可以通过$_COOKIE['key']的形式来读取某个Cookie值
//$content = ob_get_contents();
//$content = str_replace(" ", '&nbsp;', $content);
//ob_clean();
//header("content-type:text/html; charset=utf-8");
//echo '当前的Cookie为：<br>';
//echo nl2br($content);
?>
</h1>
</body>
</html>