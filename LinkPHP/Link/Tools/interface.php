<?php

/**
 * @author liujun
 * @copyright 2017
 */

//接口

interface connectAll{
    
    function connect();//接口中的方法都是抽象方法，无需声明抽象
}
class Db{
    
    public $host = "localhost";
}
//继承接口的特性，被称为：实现（implements）
class Login extends Db implements connextAll{
    
    function connect(){
        echo "<br />输入{$this->host}进行连接";
    }
}

$c1 = new Login();
$c1 -> connect();

?>