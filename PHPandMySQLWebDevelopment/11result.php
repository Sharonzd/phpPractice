<html>
<head>
    <title>book search results</title>
</head>
<body>
<h1>book search results</h1>

<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/19 16:44
 */
$searchtype = $_POST['searchtype'];  //获取提交的searchtype
$searchterm = trim($_POST['searchterm']);  //获取提交的searchterm（用户输入,需要格式化）
//先删除两边的空格再判断是否为空,防止用户输入的都是空字符
if(!$searchtype || !$searchterm){
    echo 'no input!';
    exit;
}



//判断是否已经自动完成了引号
if(!get_magic_quotes_gpc()){
//    如果还没有,对用户输入的数据使用addslashes过滤数据。如果是来自数据库的数据,可以调用stripslashes
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
    //对html中的特殊意义字符进行编码。如& <  ?  "
    $searchterm = htmlspecialchars($searchterm);
}

echo 'get input search type: '.$searchtype."<br>";
echo 'get input search type: '.$searchterm."<br>";   /// st&test<test>test\'test\'t 无法查询  ????对于字段中含有特殊字符的怎么办??、



//mysqli是php为mysql提供的函数库,可以使用面向对象或面向过程的语法。推荐面向对象的语法。

echo '-----------------------面向对象写法-------------------------'."<br>";

//建立一个连接（面向对象）, 返回一个对象
@ $db = new mysqli('127.0.0.1','bookorama','123','books','3306');
//检查连接的结果
if(mysqli_connect_errno()){
    echo mysqli_connect_errno().":".mysqli_connect_error().":".'error:could not connect to database.';
    exit;
}
//选择要使用的数据库。（其实已经在连接中选择了）
//$db->select_db('books');

//写query语句
$query = "select * from books where ".$searchtype." like '%".$searchterm."%' ";
//可以用来检查query是否写错
echo 'query : '.$query."<br>";

//运行查询,返回的是一个结果对象。 如果结果查不到,也是对象。但是如果sql语句错误,返回的便是false,此时对$result操作会导致错误。
$result = $db->query($query);
echo "result type: ".gettype($result)."<br>";

//行数
$num_results = $result->num_rows;
echo "number of books found: ".$num_results."<br>";

//作为一个结果集,被取出后就没有了,所以不能反复对结果集进行操作。
//echo 'result:'."<br>";

echo '-----------------------1 fetch_assoc  相关数组-------------------------'."<br>";
//for ($i=0;$i<$num_results;$i++){
//    //接受结果集合中的每一行并以一个相关数组返回该行。
//    $assocrow = $result->fetch_assoc();
//    foreach($assocrow as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
////    在显示从数据库获取的数据之前,要先整理其值
//    echo "<br>ISBN: ".stripslashes($assocrow['isbn']);
//}

echo '-----------------------2 fetch_row  列举数组-------------------------'."<br>";
//echo "<br>".$result->num_rows."<br>";
//for ($i=0;$i<$num_results;$i++){
//    //接受结果集合中的每一行并以一个列举数组返回该行。
//    $listrow = $result->fetch_row();
//    foreach($listrow as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
//    echo "<br>ISBN: ".stripslashes($listrow[0]);
//
//}

echo '-----------------------3 fetch_object 对象-------------------------'."<br>";
//echo $result->num_rows."<br>";
//for ($i=0;$i<$num_results;$i++){
//    //接受结果集合中的每一行并以一个列举数组返回该行。
//    $objectrow = $result->fetch_object();
//    foreach($objectrow as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
//    echo "<br>ISBN: ".stripslashes($objectrow->isbn);
//}

echo '-----------------------3 fetch_array 数组-------------------------'."<br>";
echo $result->num_rows."<br>";
for ($i=0;$i<$num_results;$i++){
    //接受结果集合中的每一行并同时有列举,也有相关的返回。可以指定参数MYSQLI_ASSOC 相当于fetch_assoc.   指定参数MYSQLI_ROW相当于fetch_row
    $arrayrow = $result->fetch_array();
    foreach($arrayrow as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
    echo "<br>ISBN: ".stripslashes($arrayrow[0]);
}

//释放结果集
$result->free();
//关闭数据库
$db->close();

echo '<br><br>-----------------------面向过程写法-------------------------'."<br>";
//建立一个连接（面向过程）,返回一个资源
@ $db2 = mysqli_connect('127.0.0.1','bookorama','123','books','3306');
//检查连接的结果
if(mysqli_connect_errno()){
    echo mysqli_connect_errno().":".mysqli_connect_error().":".'error:could not connect to database.';
    exit;
}
//选择要使用的数据库。（其实已经在连接中选择了）
mysqli_select_db($db2,'books');

$query = "select * from books where ".$searchtype." like '%".$searchterm."%' ";
//运行查询,返回的是一个结果资源
$result2 = mysqli_query($db2,$query);
$num_results2 = mysqli_num_rows($result2);
echo "number of books found: ".$num_results2."<br>";


//作为一个结果集,被取出后就没有了,所以不能反复对结果集进行操作。
echo '<br><br>-----------------------1 fetch_assoc  相关数组-------------------------'."<br>";
for ($i=0;$i<$num_results2;$i++){
    //接受结果集合中的每一行并以一个相关数组返回该行。
    $assocrow2 = $result2->fetch_assoc();
    foreach($assocrow2 as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
//    在显示从数据库获取的数据之前,要先整理其值
    echo "<br>ISBN: ".stripslashes($assocrow2['isbn']);
}

echo '<br><br>-----------------------2 fetch_row  列举数组-------------------------'."<br>";
//for ($i=0;$i<$num_results2;$i++){
//    //接受结果集合中的每一行并以一个列举数组返回该行。
//    $listrow2 = $result2->fetch_row();
//    foreach($listrow2 as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
//    echo "<br>ISBN: ".stripslashes($listrow2[0]);
//}

echo '<br><br>-----------------------3 fetch_object 对象-------------------------'."<br>";
//for ($i=0;$i<$num_results2;$i++){
//    //接受结果集合中的每一行并以一个列举数组返回该行。
//    $objectrow2 = mysqli_fetch_object($result2);
//    foreach($objectrow2 as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
//    echo "<br>ISBN: ".stripslashes($objectrow2->isbn);
//}

echo '<br><br>-----------------------3 fetch_array 数组-------------------------'."<br>";
//for ($i=0;$i<$num_results2;$i++){
//    //接受结果集合中的每一行并同时有列举,也有相关的返回。可以指定参数MYSQLI_ASSOC 相当于fetch_assoc.   指定参数MYSQLI_ROW相当于fetch_row
//    $arrayrow2 = mysqli_fetch_array($result2);
//    foreach($arrayrow2 as $key => $value){
//        echo $key."   ---   ".$value."<br>";
//    }
//    echo "<br>ISBN: ".stripslashes($arrayrow2[0]);
//}

//释放结果集
mysqli_free_result($result2);
//关闭数据库
mysqli_close($db2);
?>
</body>
</html>

