<?php
/**
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/11/30
 * Time: 16:07
 */
require_once('config.php');
if(!($con = mysqli_connect(HOST,USERNAME,PASSWORD))){
    echo mysqli_error();
};
if(!mysqli_select_db($con,'test')){
    echo mysqli_error();
};
if(!mysqli_query($con,'set names utf8')){
    echo mysqli_error();
};
