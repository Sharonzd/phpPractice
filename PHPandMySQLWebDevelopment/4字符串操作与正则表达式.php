<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/15 15:05
 */

/* 据说mail必须要在服务器上才能运行  ??  待处理Question*/
//$name = $_POST['name'];
//$email = $_POST['email'];
//$feedback = $_POST['feedback'];

$toaddress = '519106380@qq.com';
$subject = 'Feedback from web site';
$mailcontent = "customer name:".$name.'\n'."customer email:".$email.'\n'."customer comments:".$feedback.'\n';
$fromaddress = "From:zhoudan03@baidu.com";

mail($toaddress,$subject,$mailcontent,$fromaddress);

echo '-----------------------字符串的格式化   chop  trim  ltrim rtrim nl2br-------------------------'."<br>";
/* Question 只能显示\t,\n不能显示手动输入的空格换行或制表符?*/
$str = "\n\n name \t\n\n     ";
echo "\n\n name \t\n\n     ";
echo nl2br("\n\n name1 \t\n\n     ");   //过滤输出结果,以格式化字符串.用<br>代替字符串中的换行符
echo nl2br(trim("\n\n name2 \t\n\n     "));  //trim删除两边空格
echo nl2br(ltrim("\n\n name3 \t\n\n     "));  //ltrim删除左边的空格
echo nl2br(rtrim("\n\n name4 \t\n\n     "));///rtrim删除右边的空格
echo nl2br(chop("\n\n name5 \t\n\n     "));   ///chop移除右边的空格。同rtrim

echo "<br>";
echo '-----------------------为打印输出而格式化字符串 printf  sprintf-------------------------'."<br>";
/*printf将一个格式化的字符串输出到浏览器中,
sprintf返回一个格式化了的字符串,不打印
*/

$total = "300";
echo "<br>";
echo "total amount of order is $total";
echo "<br>";
printf("total amount of order is %s",$total);    /////优点在于  可以使用更游泳的转换说明来指定$total是一个浮点数
echo "<br>";
printf("total amount of order is %.2f",$total);
echo "<br>";
printf("total amount of order is %.2f with %.3f",$total,$total);
echo "<br>";
/* 使用带序号的参数方式,参数的顺序不一定要与转换说明中的顺序相同    %后写参数的位置,并以$结束（$需要转义） */
printf("total amount of order is %2\$.2f with shipping %1\$.4f",111,323);
echo "<br>";
echo sprintf("total amount of order is %2\$.2f with shipping %1\$.4f",111,323);   //返回一个格式化了字符串,保存在缓存里了。不打印。

echo '<br>-----------------------变体的函数 vprintf   vsprintf    接受两个参数:格式化字符串 参数数组-------------------------'."<br>";
echo "<br>";
$array = array(100,200);
vprintf("total amount of order is %.2f with %.3f",$array);
echo "<br>";
echo vsprintf("total amount of order is %.2f with %.3f",$array);

echo '<br>-----------------------改变字符串中的字母大小写-------------------------'."<br>";
echo strtoupper("hei hei hei")."<br>";
echo strtolower("HEI HEI HEI")."<br>";
echo ucfirst("hei hei hei")."<br>";
echo ucwords("hei hei hei")."<br>";

echo '-----------------------格式化字符串以便存储  addslashes  stripslashes-------------------------'."<br>";
$newStr = addslashes(trim("hello:my name is\ hello '123'"))."<br>";  //转化 单双引号,反斜杠,NULL字符
echo $newStr."<br>";
echo get_magic_quotes_gpc()."<br>";  ////魔术引号特征 未被启用
//如果启用了需要调用stripslashes,避免显示反斜杠
echo stripslashes($newStr)."<br>";

echo '-----------用字符串函数连接和分割字符串  array explode(string separator,string input[,int limit]);-
<br>string explode(string separator,array array)
<br>string join(string separator,array array)
------------------------'."<br>";
$email = "zhoudan03@BAIDU.com";
$email_array = explode("@",$email);
foreach($email_array as $key => $value){
    echo $key."   ---   ".$value."<br>";
}
if(strtolower($email_array[1]) === "baidu.com"){
    $toaddress = "519106380@qq.com";
    echo "111"."<br>";
}else{
    $toaddress = "sharon_zd@qq.com";
    echo '222'."<br>";
}

$new_email = implode("@",$email_array);  ///连接字符串
echo $new_email."<br>";

$new_email2 = join("@",$email_array);  ///链接字符串
echo $new_email2."<br>";

echo '-----------------------string strtok(string input,string separator)-------------------------'."<br>";
$token = strtok("abc'def'hij","'");
//一次只从字符串中取出1个片段
echo $token."<br>";
while($token != ""){
    $token = strtok("'");   ///strtok会保持它自己的内部指针在字符串中的位置。如果想重置指针,可以重新将这个字符串传递给这个函数
    echo $token."<br>";
}

echo '-----------------------substr(string string,int start[,int length])-------------------------'."<br>";
$test = "your customer service is excellent";
echo substr($test,1)."<br>";   ///得到从start指向的元素到字符串结束的整个字符串

echo substr($test,-9)."<br>";  ////得到倒数第1 ~ 9 的共9个字符

echo substr($test,0,4)."<br>";  ///从start指向的元素开始的 length个字符

echo substr($test,5,-13)."<br>";  ///从5开始,直到倒数第13个字符。

echo '-----------------------字符串的比较 strcmp strnatcmp  -------------------------'."<br>";
echo strcmp('2','12')."<br>";
echo strnatcmp('2','12')."<br>";   ///自然排序
echo '-----------------------字符串的长度   strlen-------------------------'."<br>";
echo strlen('hello')."<br>";

echo '-----------------------strstr 查找字符串  stristr strrchr-------------------------'."<br>";
$msg = "I still haven't received delivery of my last delivery order";
echo strstr($msg,'delivery')."<br>";  //返回目标关键字以及目标关键字以后的字符串
echo stristr($msg,'deliveRy')."<br>"; //不区分大小写

echo strrchr($msg,'delivery')."<br>";  //查找的是字符,如果needle包含了不止一个字符,则取第一个字符d。从最后出现d的位置的前面返回被搜索字符串der

echo '-----------------------strpos(string,goal[,offset])   strrpos-------------------------'."<br>";
echo strpos($msg,'delivery')."<br>";  ///返回目标关键字第一次被搜索到的位置。关键字的第一个字母的索引。
echo strpos($msg,'delivery',30)."<br>";  ///从offset开始查找
echo strrpos($msg,'delivery')."<br>";   ///最后一次出现目标关键字的位置

$msg = "I still haven't received delivery of my last delivery order";

//如果目标关键字不再字符串中,返回false。但是,false和0可能会误会为第一个字符。
$result = strpos($msg,"I");
echo $result."<br>";
if($result === false){   ///所以得用 === 来判断
    echo "not found"."<br>";
}else{
    echo "found".$result."<br>";
}

echo '-----------------------替换子字符串--------str_replace(needle,new_needle,haystack[,count])  count表示替换的次数。
<br>substr_replace(string,replacement,start,[length])
-----------------'."<br>";
$offcolor=array('fuck','hit');
$feedback = 'he ha ha fuck you';
$feedback = str_replace($offcolor,'%!@*',$feedback);
echo $feedback."<br>";

$feedback = substr_replace($feedback,'&&&', -3, 1);  //-1 代表最后,-3代表倒数第三个,从倒数第三个开始,替换到最后。或者指定length。。用&&&替换掉y。
echo $feedback."<br>";


echo '-----------------------正则表达式查找字符串  int ereg(pattern, search , 【matches】)  或者eregi 不区分大小写-------------------------'."<br>";
$email = 'zhoudan03@baidu.com';
if(!eregi('^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$email)){
    echo 'that is not a valid email'."<br>";
}else{
    echo 'valid'."<br>";
}

echo '-----------------------用正则表达式替换子字符串--- ereg_replace(pattern,replacement,search)   eregi_replace----------------------'."<br>";

echo '-----------------------使用正则表达式分割字符串--- split(pattern,search,【max])----------------------'."<br>";

$address = 'username@example.com';
$arr = split("\.|@",$address);
while (list($key,$value) = each($arr)){
    echo $value."<br>";
}

?>

