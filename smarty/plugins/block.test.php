<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/23
 * Time: 18:11
 */
//其实不同的插件名称是不可以相同的，即便前缀不一样也不可以
//参数1为打包好的关联数组，参数2为插件中间要处理的数据
function smarty_block_test($params,$content){
    $replace = $params['replace'];
    $maxnum = $params['maxnum'];
    if($replace == 'true'){
        $content = str_replace('，',',',$content);
        $content = str_replace('。','.',$content);
    }
    $content = substr($content,0,$maxnum);
    return $content;
}