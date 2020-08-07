<html>
<head>
    <title>book o rama book entry result</title>
</head>
<body>
<h1>book o rama book entry result</h1>
<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/22 11:18
 */
$isbn = $_POST['isbn'];
$author = $_POST['author'];
$title = $_POST['title'];
$price = $_POST['price'];

if(!$isbn || !$author || !$title || !$price){
    echo "you have not entered all the required details<br>";
    exit;
}

if(!get_magic_quotes_gpc()){
    $isbn = addslashes($isbn);
    $author = addslashes($author);
    $title = addslashes($title);
//    当价格以浮点数的形式保存在数据库时,不希望在小数点前后插入斜杠。调用doubleval可以过滤,去除所有临时字符
    $price = doubleval($price);
}

@ $db = new mysqli('127.0.0.1','bookorama','123','books');

if (mysqli_connect_error()){
    echo "Error: could not connect to database."."<br>";
    exit;
}

//$query = "insert into books VALUE ('$isbn','$author','$title','$price')";
//有什么区别么?
//$query = "insert into books VALUE ('".$isbn."','".$author."','".$title."','".$price."')";

//
//echo $query."<br>";
//
//$result = $db->query($query);
//
//if($result){
////    返回影响的行数
//    echo $db->affected_rows." book inserted into database. <br>";
//}else{
//    echo "an error occurred";
//}


echo '-----------------------使用prepared语句,提高执行速度,也免受SQL注射风格的攻击-------------------------'."<br>";
$query = "insert into books value (?,?,?,?)";
$stmt = $db->prepare($query); //构建一个语句对象
$stmt->bind_param("sssd",$isbn,$author,$title,$price);  //绑定参数。sssd代表字符串、字符串、字符串、双精度
$stmt->execute();

if($stmt->errno){
    echo "errorNo ".$stmt->errno.":";
    echo $stmt->error;
}else{
    echo $stmt->affected_rows." book inserted into database<br>";
}
$stmt->close();


/* question   */
//$select_query = "select * from books WHERE ? = ?";
//$search_type='author';
//$search_term="zhoud";
//echo $select_query."<br>";
//$select_stmt = $db->prepare($select_query);
//$select_stmt->bind_result($search_type,$search_term);
//$select_stmt->execute();
//if($select_stmt->errno){
//    echo "errorNo".$select_stmt->errno.":".$select_stmt->error;
//}else{
//
//    $select_stmt->fetch();
//}
//$select_stmt->close();

$db->close();


?>
</body>
</html>
