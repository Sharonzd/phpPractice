<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/23
 * Time: 17:58
 */
//(参数1，参数2)
function smarty_modifier_test($utime,$format){
    return date($format,$utime);
}