<?php
/**
 * File:
 * Auther: zhoudan03
 * Datetime: 16/8/17 16:52
 */

function hello($param1,$param2){
    try{
        throw new Exception("A terrible error has occured",42);
    }
    catch (Exception $e){
//        line 10 为抛出异常的行号
        echo "Exception ".$e->getCode().":".$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine()."<br>";
        //返回一个包含了产生异常的代码回退路径的数组。
        foreach($e->getTrace() as $key => $value){
            echo $key."   ---   ".$value."<br>";
//            回退路径也是一个数组,显示了发生异常时锁执行的函数(文件名,函数执行的行号,函数名称,函数参数数组)。
            foreach($value as $pos => $current){
                echo $pos."   ---   ".$current."<br>";
                if($pos === 'args'){
                    foreach($current as $arg_key => $arg_value){
                        echo $arg_key."   ---   ".$arg_value."<br>";
                    }
                }
            }

        }
        echo "<br>";
//以字符串的形式返回getTrace信息
        echo $e->getTraceAsString();
        echo "<br>";
//        调用__toString,给出$e的所有以上信息
        echo $e;

    }
}
hello(1,2);


echo "<br>";
echo '-----------------------Exception类-------------------------'."<br>";
//用户自定义Exception类
class myException extends Exception{
    function __toString()
    {
//        parent::__toString(); // TODO: Change the autogenerated stub
        return "-----".$this->getFile().'----';
    }
}
try{
    throw new myException('another terrible error', 42);
}catch (myException $m){
    echo $m;
}

echo "<br>";

class fileOpenException extends Exception{
    function __toString()
    {
//        parent::__toString(); // TODO: Change the autogenerated stub
        return "fileOpenException ".$this->getCode().":".$this->getMessage()." in ".$this->getFile()." on line ".$this->getLine();
    }
}

class fileWriteException extends Exception{
    function __toString()
    {
        return "fileWriteException ".$this->getCode().":".$this->getMessage()." in ".$this->getFile()." on line ".$this->getLine();
    }
}

class fileLockException extends Exception{
    function __toString()
    {
        return "fileLockException ".$this->getCode().":".$this->getMessage()." in ".$this->getFile()." on line ".$this->getLine();
    }
}

try{
    if(!($fp = @fopen('','ab'))){
        throw new fileOpenException();
    }
    if(!flock($fp,LOCK_EX)){
        throw new fileLockException();
    }
    if(!fwrite($fp,$outpuststring,strlen($outputstring))){
        throw new fileWriteException();
    }
    flock($fp,LOCK_UN);
    fclose($fp);
//    如果异常没有匹配到catch语句,会报错。
}catch(fileOpenException $foe){
    echo "file open error<br>";
}catch (fileLockException $fle){
    echo "file lock error<br>";
}catch (fileWriteException $fwe){
    echo "file write exception<br>";
}