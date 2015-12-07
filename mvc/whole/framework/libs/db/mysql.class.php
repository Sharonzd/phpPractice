<?php
/** php操作mysql类的封装
 * 减少代码冗余，提高开发速度。
 * 降低编程错误
 * 便于维护升级
 * Created by PhpStorm.
 * User: zhoudan03
 * Date: 2015/12/1
 * Time: 11:25
 */
class mysql{  //类是全局的

    /**
     * 报错函数
    */
    function err($error){
        die("对不起，您的操作有误，错误原因为：".$error);  //输出信息并退出
    }
    /**  连接主机并选择数据库，设置字符集
     * @param string $dbhost 主机名
     * @param string $dbuser 用户名
     * @param string $dbpsw  密码
     * @param string $dbname 数据库名
     * @param string $dbcharset 字符集/编码
     * @return bool  连接成功或不成功
     */
    function connect($config){
        $test = extract($config);  //提取变量，数组中的每个元素，键用于变量名(不要加$，提取出来的时候会自动加$)，键值用于变量值。提取出来后就直接成了变量了，可以直接调用。返回成功设置的变量数目
        if(!($con = mysql_connect($dbhost,$dbuser,$dbpsw))){    //连接mysql
            $this ->err(mysql_error());
        }
        if(!mysql_select_db($dbname)){         //选择数据库
            $this -> err(mysql_error());
        }
        mysql_query("set names ".$dbcharset);  //设置字符集
    }

    /**
     * 执行sql语句, 返回资源
    */
    function query($sql){
        if(!($query = mysql_query($sql))){
            $this->err($sql."<br/>".mysql_error());
        }else{
            return $query;
        }
        return false;
    }

    /**
     * 获取资源中的列表数组，返回数组
    */
    function findAll($query){
        while($rs = mysql_fetch_array($query,MYSQL_ASSOC)){
            $list[]=$rs;
        }
        return isset($list)?$list:'';
    }

    /**
     * 获取资源中的一条数据，返回一条数据
    */
    function findOne($query){
        $rs = mysql_fetch_array($query,MYSQL_ASSOC);
        return $rs;
    }

    /**
     * 返回指定行的指定字段
    */
    function findResult($query,$row=0,$field=0){
        $rs = mysql_result($query,$row,$field);
        return $rs;
    }

    /**
     * 插入函数
     * $table  表名
     * $arr  包含字段和值的一维数组
     * insert into table(key1,key2,key3) values(value1,value2,value3);
    */
    function insert($table,$arr){
        $keyArr = array();
        $valueArr = array();
        foreach($arr as $item => $value){
            $value = mysql_real_escape_string($value);  //对字符串的特殊字符转义。
            $keyArr[] = "`".$item."`";   //把$arr数组中的键名保存到$keyArr数组中。两边应用分隔符``(不能使单引号'')是为了防止key中有像from一样的sql关键字
            $valueArr[] = "'".$value."'";  //把$arr数组中的键值保存到$valueArr数组中。因为值多为字符串。
//            循环完后$keyArr为 array(`a`,`b`,`c`);    $valueArr为array('1','2','3');
        }
        $keys = implode(",",$keyArr);   ///将数组按分隔符组合成字符串
        $values = implode(",",$valueArr);
        $sql = "insert into $table($keys) values ($values)";  //sql插入语句
        $this -> query($sql);  //调用类自身的query方法执行此插入语句
        echo $sql;
        return mysql_insert_id();  //返回插入id
    }

    /**
     * 修改函数
     * $table 表名
     * $arr 包含字段和值的一维数组
     * $where 更新条件
     * update table set key1=value1,key2=value2,key3=value3 where condition
     */
    function update($table,$arr,$where){
        $updateArr=array();
        foreach ($arr as $item=>$value) {
            $value = mysql_real_escape_string($value);
            $updateArr[] = "`".$item."`='".$value."'";
        }
        $updates=implode(",",$updateArr);
        $sql="update $table set $updates where $where";
        return $this->query($sql);
    }

    /**
     * 删除函数
     * delete from table where
    */
    function delete($table,$where){
        $sql="delete from $table where $where";
        return $this->query($sql);
    }
}
//$mysql = new mysql();
//注意config不要写$。 extract函数会帮忙做这件事
//$config = array('dbhost' => 'localhost','dbuser'=>'root','dbpsw'=>'','dbname'=>'test','dbcharset'=>'utf8');
//$mysql ->connect($config);
//$mysql -> insert("user",array('where'=>1,'from'=>2,'c'=>'xxx'));
