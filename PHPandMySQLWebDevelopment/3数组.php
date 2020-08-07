<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/12 20:03
 */
$array = array('a'=>'aaa','b'=>'bbb','c'=>'ccc');
echo '-----------------------循环-------------------------'."<br>";

echo '-----------------------foreach-------------------------'."<br>";
foreach($array as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '---------注意,foreach、each,数组都会记录当前元素。如果希望再次使用数组,必须使用reset将当前元素指针重置到数组开始处----------------'."<br>";
reset($array);

echo '----------------each--------------------------------'."<br>";
/*each 会按顺序返回数组的当前元素*/
while($element = each($array)){  //将当前元素赋值给$element
    /*$element是一个数组,  位置key和0保存了当前元素的关键字, 位置value和1保存了当前元素的值
     * [
     * 1:aaa,
     * value:aaa,
     * 0:a,
     * key:a
     * ]
     * */
    echo $element."<br>";
    foreach($element as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
    echo $element['key']." --- ".$element['value']."<br>";
}

reset($array);
echo '-----------------------list and each-------------------------'."<br>";
/* list 使得从each返回的数组中包含0,1的两个元素编程两个名为$key,$price的新变量     相当于为变量重命名*/
while(list($key,$value) = each($array)){
    echo "$key -- $value <br>";
}


reset($array);
echo '-----------------------数组操作符 之  +  联合 -------------------------'."<br>";
/*  不会影响原数组。  将b数组添加到a数组之后, 如果b中有a的属性,不会被覆盖 */
$arrayb = array('c'=>'c222','d'=>'ddd');
$newarray =  $array + $arrayb;
foreach($newarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------sort 给无key的纯元素 数组排序-------------------------'."<br>";
/* 数字排在所有的字母前  大写字母 排在所有的小写字母前   第2个参数有SORT_REGULAR（默认）、SORT_NUMERIC、SORT_STRING,*/
$sortarray = array('tire','Tie','oil','spa','123','23');
sort($sortarray);
foreach($sortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------sort 传递 SORT_STRING-------------------------'."<br>";
sort($sortarray,SORT_STRING);
foreach($sortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

/*  所以asort、ksort可以给关联数组排序。 sort只能数字索引排序给*/


$asortarray = array('tire'=>100,'Tie'=>10,'oil'=>123,'spa'=>1);

echo '-----------------------sort 给有key的元素 数组  （关联数组）-------------------------'."<br>";
/* 如果是对有key的元素 用sort排序, 会按值的大小排,同时key会丢失 */
sort($asortarray);
foreach($asortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

$asortarray = array('tire'=>100,'Tie'=>10,'oil'=>123,'spa'=>1);
echo '-----------------------asort 按值排序-------------------------'."<br>";
asort($asortarray);
foreach($asortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

$asortarray = array('tire'=>100,'Tie'=>10,'oil'=>123,'spa'=>1);
echo '-----------------------ksort 按关键字排序-------------------------'."<br>";
ksort($asortarray);
foreach($asortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------rsort 给一维数字索引数组 降序排序-------------------------'."<br>";
rsort($sortarray);
foreach($sortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------arsort 给关联数组 按值降序排列-------------------------'."<br>";
arsort($asortarray);
foreach($asortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}
echo '-----------------------krsort 给关联数组 按key降序排列-------------------------'."<br>";
krsort($asortarray);
foreach($asortarray as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------多维数组的排序  usort 用户定义排序-------------------------'."<br>";
$products = array(array('TIR','tir',100),array('OIL','oil',10),array('SPK','spark',4));

//按订单的第二列排序
function compare($x,$y){   ///$x,$y是主数组中的两个子数组
    if($x[1] == $y[1]){
        return 0;
    }elseif($x[1]>$y[1]){
        return 1;
    }else{
        return -1;
    }
}
usort($products,'compare');

//打印二维数组
for ($row = 0; $row < 3; $row++){
    for($column=0; $column<3; $column++){
        echo '  |   '.$products[$row][$column];
    }
    echo '  |'."<br>";
}

echo '-----------------------按第三列排序 usort-------------------------'."<br>";
//按订单的第三列排序
function compare2($x,$y){
    if($x[2] == $y[2]){
        return 0;
    }elseif ($x[2]>$y[2]){
        return 1;
    }else{
        return -1;
    }
}
usort($products,'compare2');

for ($row = 0; $row < 3; $row++){
    for($column=0; $column< 3; $column++){
        echo '  |   '.$products[$row][$column];
    }
    echo '  |'."<br>";
}

$products2 = array('row2'=>array('TIR','tir',100),'row3'=>array('OIL','oil',10),'row1'=>array('SPK','spark',4));


/*??????????????????????????   有空再想好例子*/
echo '-----------------------uasort-------------------------'."<br>";
function compare3($x,$y){
    ///
    ///
    ///
    ///
    foreach($x as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
    echo '------------------------------------------------'."<br>";
    foreach($y as $key => $value){
        echo $key."   ---   ".$value."<br>";
    }
//    if($x[2] == $y[2]){
//        return 0;
//    }elseif ($x[2]>$y[2]){
//        return 1;
//    }else{
//        return -1;
//    }
}
uasort($products2,'compare3');

echo '-----------------------uksort-------------------------'."<br>";

/*??????????????????????????*/

echo '----------------------- 用户排序-  usort  降序排列-----------------------'."<br>";
function reverse_compare($x,$y){
    if($x[2] == $y[2]){
        return 0;
    }elseif ($x[2]>$y[2]){
        return -1;
    }else{
        return 1;
    }
}
usort($products,'reverse_compare');
for ($row = 0; $row < 3; $row++){
    for($column=0; $column<3 ; $column++){
        echo '  |   '.$products[$row][$column];
    }
    echo '  |'."<br>";
}

echo '-------------------------对一维数组/二维数组重新排序   shuffle  随机排序   可以用来首页图片的随机展示-----------------------'."<br>";
shuffle($products);
for ($row = 0; $row < 3; $row++){
    for($column=0; $column< 3; $column++){
        echo '  |   '.$products[$row][$column];
    }
    echo '  |'."<br>";
}

echo '-------------------------对一维数组重新排序   array_reverse  反向排序   不会改变原数组。要用新数组存着结果- ----------------------'."<br>";
$newProducts3 = array_reverse($products);
for ($row = 0; $row < 3; $row++){
    for($column=0; $column< 3; $column++){
        echo '  |   '.$newProducts3[$row][$column];
    }
    echo '  |'."<br>";
}

echo '---------------------创建一个按逆序包含数字10到1的数组- array_reverse--------------------------'."<br>";
$numbers2 = range(1,10);  //range（）会创建一个升序序列
$numbers2 = array_reverse($numbers2);  //当然也可以如此用新的副本覆盖原来的版本的数组
foreach($numbers2 as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------创建一个按逆序包含数字10到1的数组--array_push-----------------------'."<br>";
$numbers = array();
for ($i=10;$i>0;$i--){
    array_push($numbers,$i);
}
foreach($numbers as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '---------------------创建一个按逆序包含数字10到1的数组--rsort-------------------------'."<br>";
$numbers3 = range(1,10);  //range（）会创建一个升序序列
rsort($numbers3);  //当然也可以如此用新的副本覆盖原来的版本的数组
foreach($numbers3 as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '---------------------创建一个按逆序包含数字10到1的数组--range-------------------------'."<br>";
$numbers4 = range(10,1,-1);  ////实测情况是即便没有-1,也是逆序????????? Question
foreach($numbers4 as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------从文件中载入数组-------------------------'."<br>";
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

$orders = file("$DOCUMENT_ROOT/../phpdata/orders.txt");
$number_of_orders = count($orders);
if($number_of_orders == 0){
    echo 'no orders'."<br>";
}
for ($i=0;$i<$number_of_orders;$i++){
    echo $orders[$i]."<br>";
}
echo $number_of_orders."<br>";

echo "<table border=\"1\">\n";
echo "<tr><th bgcolor=\"#CCCCFF\">Order Date</th>
            <th bgcolor=\"#CCCCFF\">Tires</th>
            <th bgcolor=\"#CCCCFF\">Oil</th>
            <th bgcolor=\"#CCCCFF\">Spark Plugs</th>
            <th bgcolor=\"#CCCCFF\">Total</th>
            <th bgcolor=\"#CCCCFF\">Address</th>
         <tr>";
for($i=0;$i<$number_of_orders;$i++){
    $line = explode("\t",$orders[$i]);   ////用explode拆分成区段

    $line[1] = intval($line[1]);
    $line[2] = intval($line[2]);
    $line[3] = intval($line[3]);

    // output each order
    echo "<tr>
             <td>".$line[0]."</td>
             <td align=\"right\">".$line[1]."</td>
             <td align=\"right\">".$line[2]."</td>
             <td align=\"right\">".$line[3]."</td>
             <td align=\"right\">".$line[4]."</td>
             <td>".$line[5]."</td>
          </tr>";
}
echo "</table>";

echo '-----------------------each current reset pos next end prev-------------------------'."<br>";
$arrayPos = array('aaa', 'bbb', 'ccc');   ///指针被初始化,指向数组的第一个元素
echo current($arrayPos)."<br>";   ///返回当前元素的位置
while($element = each($arrayPos)){  /////先返回当前元素,然后指针前移一个位置
    echo $element['key']." --- ".$element['value']."<br>";
}
echo reset($arrayPos)."<br>";     ///重置指针,指向第一个元素。
echo pos($arrayPos)."<br>";       ///返回当前指针所指向的元素
echo next($arrayPos)."<br>";      ///指针前移动一个元素,并返回移动后指针所指向的元素
echo end($arrayPos)."<br>";       ///返回数组的最后一个元素
echo prev($arrayPos)."<br>";      ///指针前移一个元素,并返回当前元素

echo '-----------------------对每一个元素应用任何函数 array_walk-------------------------'."<br>";
function my_print($value){
    echo $value."<br>";
}
array_walk($arrayPos,'my_print');

function my_multiply(&$value,$key,$factor){    ////&引用方式传递,允许函数修改数组的内容
    $value .= $factor;
}
array_walk($arrayPos,'my_multiply',3);
foreach($arrayPos as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------统计数组元素的个数-------------------------'."<br>";
echo count($arrayPos)."<br>";
echo sizeof($arrayPos)."<br>";

echo '----------------------统计元素出现的频率 array_count_values--------------------------'."<br>";
$arrayCount = array(4,5,1,2,3,1,2,1);
$ac = array_count_values($arrayCount);
foreach($ac as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------将数组转化成标量变量 extract------------------------'."<br>";
/*extract(array,extract_type,prefix) 可指定冲突解决方式,可加前缀,  对于冲突,默认是覆盖*/
$arrayExtract = array('key1'=>'value1','key2'=>'value2','key3'=>'value3');
extract($arrayExtract);
echo $key1.' '.$key2.' '.$key3."<br>";
echo isset($key1)."<br>";   //true