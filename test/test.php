<?php
//引入smarty类文件
require('../smarty/Smarty.class.php');
//实例化smarty类的对象
$smarty = new Smarty();

//五个重要的配置
$smarty->left_delimiter = "{";  //左定界符
$smarty->right_delimiter = "}";   //右定界符
$smarty->template_dir = "tpl";  //指定html模板的地址
$smarty->compile_dir = "template_c";
//模板编译生成的文件，smarty编译成的php能够处理的语句，为了避免资源的浪费，就暂存起来，这样只要模板没有更改，就直接取出此文件夹的编译文件
$smarty->cache_dir = "cache";//缓存，文件缓存，数据库的数据，运算的输出等等。

//被{}扩起来的都会被smarty解析

//以下是开启缓存的另两个配置，但是通常不用smarty的缓存机制
$smarty->caching = true;   //开启缓存，默认是关闭的
$smarty->cache_lifetime = 120;  //缓存的有效时间，在这一段时间smarty都会直接读取缓存

//smarty作为一个类，内置了很多方法，smarty常用的方法
$smarty->assign('articletitle', '文章标题');   //在smarty模板里赋值变量

$arr = array('title'=>'smarty的学习','author'=>'小明');
$arr2 = array('articlecontent'=>array('title'=>'smarty的学习','author'=>'小明'));
$smarty->assign('arr');


$smarty->assign('articletitle','i ate an apple');
$smarty->assign('time',time());
$smarty->assign('articletitle','');
$smarty->assign('url','http:wrewf?gf.gdjkkkkkk ');
$smarty->assign('articletitle','Happy New Year');
$smarty->assign('articlecontent','开心的一天
开心的一天
开心的一天');

$smarty->assign('score',91);


$articlelist = array(
    array("title"=>"第一篇文章","author"=>"小王","content"=>"第一篇文章该写点啥"),
    array("title"=>"第二篇文章","author"=>"小李","content"=>"第二篇文章该写点啥")
);

$smarty->assign("articlelist",$articlelist);

//声明类
class My_Object{
    function methl($param){
        return $param[0].'已经'.$param[1];
    }
}
//实例化一个对象
$myobj = new My_Object();
//将对象赋值到模板的变量里
$smarty->assign('myobj',$myobj);

$smarty->assign('str','abcdefg');

///自定义函数
function test($params){
    print_r($params);   //打印出来的是Array([p1]=>abc [p2]=>edf)
//    所以smarty的参数传递都是会打包成数组的形式，所以用数组的取数据方式来取
    exit;

    $p1 = $params['p1'];
    $p2 = $params['p2'];
    return '传入参数1的值为'.$p1.',传入参数2的值为'.$p2;
}


$smarty->display('test.tpl');  //展示

$smarty->display('area.tpl');


$smarty->assign('time',time());
$smarty->display('datetime.tpl');

//block区块自定义插件使用方式
$smarty->assign('str', 'Hello，my name is Han meimei。how are you？');

