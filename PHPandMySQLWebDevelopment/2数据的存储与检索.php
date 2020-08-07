<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/12 11:17
 */

/*定义简短名称*/
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

$path = "$DOCUMENT_ROOT/../phpdata/orders.txt";
$lockpath = "$DOCUMENT_ROOT/../phpdata/lockfile.txt";
/**/

/* b 使得脚本的移植性更好*/
@ $fp = fopen($path,'rb');
if(!$fp){
   echo '<p>Your order could not be processed</p>' ;
    exit;  //报错后 不再执行后面的脚本
}

fwrite($fp,' new 123');
fclose($fp);


echo '-----------------------读文件-------------------------'."<br>";
@ $fp = fopen($path,'rb');
if(!$fp){
    echo '<p>Your order could not be processed</p>' ;
    exit;  //报错后 不再执行后面的脚本
}
echo '-----------------------fgets（resource fp,int length）-------------------------'."<br>";
while (!feof($fp)){    //file end of file     当指针指向文件末尾的时候,返回true
    //每次读取一行,直到读到一个换行字符\n  or  文件结束符eof   or   从文件读入了998B（可读取的最大长度为参数-1B）   需要按块方式处理文件时,此函数十分有用
    $order = fgets($fp,999);
    echo $order."<br>";
}

echo '--------------------------rewind 将文件指针复位到文件的开始----------------------'."<br>";
rewind($fp);
echo '-----------------------fgetss(resource fp, int length[, string allowable_tags])-------------------------'."<br>";
while(!feof($fp)){
    //同fgets,但是可以过滤字符串中包含的php和html标记,更加安全。第三个参数代表允许的标记。
    $order = fgetss($fp,999,'<p></p>');
    echo $order."<br>";
}

echo "<br>";
rewind($fp);
echo '-----------------------fgetcsv(resource fp, int length[,string delimiter [,string enclosure]] ------------------'."<br>";
while(!feof($fp)){
    //同fgets,但是可以根据分隔符将文件分成多行,并返回一个数组。length应该比每一行的字符数大,如果小的话就截断,增加一行。enclosure指定每行中封闭每一个域的字符,默认是 "
    $order = fgetcsv($fp,999,'\t ','r');
    echo gettype($order);
    foreach ($order as $key => $value){
        echo $key." : ".$value."<br>";
        echo gettype($value)."<br>";
    }
}


/* 如果既不修改文件,也不在特定位置检索,只想把文件的内容下载到输出缓冲区,应该使用readfile,以省去fopen调用*/
echo '-----------------------读取整个文件  readfile-------------------------'."<br>";
/* 自己打开这个文件,并且将文件内容输出到标准输出。 返回字节总数*/
$number = readfile($path);
echo "<br>".$number."<br>";

echo '-----------------------读取整个文件 fpassthru-------------------------'."<br>";
/* 需要先用fopen打开。*/
rewind($fp);
$number2 = fpassthru($fp);
echo "<br>".$number2."<br>";

echo '------------------------读取整个文件 file------------------------'."<br>";
/*结果会被存储到一个数组中, php4.3.0之前不安全*/
$array =  file($path);
echo gettype($array)."<br>";
foreach($array as $key => $value){
    echo $key."   ---   ".$value."<br>";
}

echo '-----------------------读取整个文件 file_get_contents-------------------------'."<br>";
/*同readfile 但是返回到字符串中,不会回显到标准输出*/
echo file_get_contents($path)."<br>";

echo '-----------------------读取一个字符 fgetc-------------------------'."<br>";
rewind($fp);
$i = 0;
while (!feof($fp)){
    if(!feof($fp)){   //fgetc会返回文件结束符。而fgets不会
        $char = fgetc($fp);
        $i++;
        echo $char;
    }
}

echo feof($fp)."<br>";           //1     可能是因为这个文件没有输入文件结束符,所以为1
echo gettype(feof($fp))."<br>";  //boolean
echo $i."<br>";  //128  最后一个元素 通过    echo ord($char)."<br>";  可以获得为 null

echo '-----------------------读取任意长度 fread-------------------------'."<br>";
rewind($fp);
echo fread($fp,10)."<br>"; /// 要么读满了length，要么读到了文件末尾,要么网络数据包结束

echo '-----------------------查看文件是否存在 file_exists-------------------------'."<br>";
if(file_exists($path)){
    echo 'file exists!!!'."<br>";
}else{
    echo 'file not exists!!!!'."<br>";
}

echo '-----------------------确定文件大小 filesize-------------------------'."<br>";
echo filesize($path)."<br>";

echo '-----------------------结合filesize 和 fread 一次性读取整个文件或者文件的某部分-------------------------'."<br>";
rewind($fp);
echo nl2br(fread($fp,filesize($path)))."<br>";   ///nl2br将输出的\n字符转换成<br>

echo '-----------------------删除一个文件 unlink-------------------------'."<br>";
echo '123'."<br>";
$unlink = unlink("$DOCUMENT_ROOT/../phpdata/unlinkfile.txt");  ///失败返回false,成功返回true
$unlinkstr = strval($unlink);
/*   Question1 如何才能打印出布尔值false,明明已经将其转化为了字符串为什么还是打印不出来呢?
      而且unlink不需要权限么?,没有权限的文件居然也能删除成功
     */
echo $unlinkstr;
echo gettype($unlinkstr);

echo '-----------------------rewind把指针复位到文件的开始-------------------------'."<br>";
echo '-----------------------ftell以字节为单位报告文件指针当前在文件中的位置-------------------------'."<br>";
echo ftell($fp)."<br>";
echo '-----------------------fseek 将文件指针指向文件的某个位置-------------------------'."<br>";
echo fseek($fp,10)."<br>";
echo ftell($fp)."<br>";  //成功移动到了10的位置,默认为 0代表SEEK_SET即文件的开始处

echo fseek($fp,10,1)."<br>";   //以当前位置为基准,进行offset偏移量便宜,1 代表SEEK_CUR
echo ftell($fp)."<br>";  //移动到了20

echo fseek($fp,10,SEEK_CUR)."<br>";   //以当前位置为基准,进行offset偏移量便宜,1 代表SEEK_CUR
echo ftell($fp)."<br>";  //移动到了30

echo fseek($fp,10,2)."<br>";   //以当前位置为基准,进行offset偏移量便宜  2代表SEEK_END
echo ftell($fp)."<br>";  //移动到了137   即便超出文件的长度,也能继续移动

fclose($fp);

echo '-----------------------文件锁定flock,如果使用了flock,就必须将其添加到所有使用文件的脚本中------------------------'."<br>";
$lockfp = fopen($lockpath,'ab');


/*
 * lock_nb意味着无阻塞。当你尝试锁定一个文件的时候,php脚本会停止,对flock的调用从继续变成阻塞,直到被访问的文件的并发锁被移除。
 * 一般情况下,你的进程都是唯一一个尝试锁定该文件的,所以对于 flock的阻塞调用实际上会立马返回。只是刚好如果两个进程锁定的同一个文件,它们两者之1才会被暂停。
 * 然而LOCK_NB将会使得flock()在任何情况下都会被立即返回。在这个设置下,你必须检查返回状态,来看看是否真的获得了这个锁。
 *while(!flock($lockfp,LOCK_NB)){  //防止在请求加锁的时候发生阻塞
    sleep(1);
}
 * 会或多或少的模拟正常的阻塞调用行为,目的当然是做一些有意义的事情而不仅仅是等待。当这个文件仍然被别的进程给锁定了。
 * */

flock($lockfp, LOCK_EX);  //写锁定
fwrite($lockfp,'123');   //写文件
readfile($lockpath);
flock($lockfp,LOCK_UN); //释放锁

