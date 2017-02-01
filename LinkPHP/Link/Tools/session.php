<?php

/**
 * @author liujun
 * @copyright 2017
 * 有效期[回话周期结束]
 * 有效路径[整站有效]
 * 有效域[当前域有效]
 * 是否仅为安全连接传输
 * 是否仅为http传输
 */
session_set_cookie_params(3600); //设置session
session_start();//开启session机制
$_SESSION['mid'];
session_destroy();//销毁当前session对应的数据区，关闭session机制
Unset($_SESSION);//销毁变量
setcookie(session_name(),'',time()-1);//销毁cookie中的seesion-id
$_SESSION = array(); //清空session数据
?>