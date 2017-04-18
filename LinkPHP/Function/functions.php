 <?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架系统公共函数文件            *
 * --------------------------------------------------*
 */

function error($url,$info=null,$wait=3){
    if (is_null($info)){
        header('location:' . $url);
    } else{
        //提示后，refresh：N;URL=$URL
        header("Refresh:$wait;URL=$url");
        echo $info;
    }
    die;
  }


/**
 * 封装C方法用于动态获取以及配置文件
 * @param [string] $name 配置名
 * @param [string] $value 配置值
 * return [string] 返回指定键名的键值
 * 未传入$value时默认null，进行获取项目配置
 * 传入$value时此时为动态配置
 * array_merge() 将2个以及多个数组合并成一个数组，重复的键名在后传入的键值
 * 覆盖最先传入的键值
 * 大C方法加载顺序 当扩展配置开启时首先加载应用模块扩展配置默认扩展配置关闭不进行加载
 * 分组扩展配置的值不会被之后加载进来的配置值覆盖，当应用模块中的键名不存在
 * 然后加载LinkPHP框架系统配置 -> 网站公共配置
 */
function C($name, $value = null){
    if(CK('EXTEND_MODEL_CONFIG', 'TRUE') == 'TRUE'){
        $platform = isset($_GET[CK('VAR_PLATFORM','TRUE')]) ? ucfirst($_GET[CK('VAR_PLATFORM','TRUE')]) : CK('DEFAULT_PLATFORM','TRUE');
        $extend_config['extend'] = require APPLICATION_PATH . $platform . '/Conf/Conf.php';
        if(array_key_exists($name, $extend_config['extend'])){
        return $extend_config['extend'][strtoupper($name)];
       }
       elseif(!array_key_exists($name,$extend_config['extend'])){
        $config['link'] = require CONF_PATH . 'conf.php';
        $config['common'] = require APPCONF_PATH . 'Conf.inc.php';
        $config['conf'] = array_merge($config['link'], $config['common']);
        return $config['conf'][strtoupper($name)]; 
       } 
    } else {
        if($value == null){
            $config['link'] = require CONF_PATH . 'conf.php';
            $config['common'] = require APPCONF_PATH . 'Conf.inc.php';
            $config['conf'] = array_merge($config['link'], $config['common']);
            return $config['conf'][strtoupper($name)];
        } else {
            
        } 
    }      
}

/**
 * 应用模块检测扩展配置方法
 * @param [string] $name 需要检测配置名称
 * @value [boolean] 默认为flase ck方法为检测是否存在配置项如果为TRUE则返回配置项的值CK方法获取不到
 * 应用扩展配置项，只能获取项目以及框架公共配置项，如果开启扩展配置项请使用C方法获取
 * @return [bool] 返回检测
 */
 function CK($name,$value='false'){
    if($value == 'TRUE'){
        $config['link'] = require CONF_PATH . 'conf.php';
        $config['common'] = require APPCONF_PATH . 'Conf.inc.php';
        $config['conf'] = array_merge($config['link'], $config['common']);
        return $config['conf'][strtoupper($name)];
    } else {
        $config['link'] = require CONF_PATH . 'conf.php';
        $config['common'] = require APPCONF_PATH . 'Conf.inc.php';
        $config['conf'] = array_merge($config['link'], $config['common']);
        if(in_array(strtoupper($name), $config['conf'])){
            return TRUE;
        } else {
            return FALSE;
        }
    }       
 }
 
 /**
  * U方法自动生成URL
  * @param $c [string] 需要设置跳转的控制器 默认为空获取当前控制器名
  * @param $a [string] 需要设置跳转的方法名 默认为空获取当前方法名
  * @param $p [string] 需要设置跳转的模块名 默认为空获取当前的模块名
  * @return url [string] 返回拼接好的URL跳转地址
  */
 function U($c=null,$a=null,$p=null){
    $platform = isset($_GET[C('VAR_PLATFORM')]) ? ucfirst($_GET[C('VAR_PLATFORM')]) : C('DEFAULT_PLATFORM');
    $p = is_null($p) ? $platform : $p;
    $c = is_null($c) ? $_GET[C('VAR_CONTROLLER')] : ucfirst($c);
    $a = is_null($a) ? $_GET[C('VAR_ACTION')] : ucfirst($a);
    $url = 'index.php?' . C('VAR_PLATFORM') . '=' . $p . '&' . C('VAR_CONTROLLER') . '=' . $c . '&' . C('VAR_ACTION') . '=' . strtolower($a);

    return $url;
 }

 /**
  * L方法 获取系统语言包
  */
 function L($language){
     switch(C('DEFAULT_LANGUAGE')){
         case 'cn':
             $conf = require LINKPHP_PATH . 'Lang/cn.Lang.php';
             break;
         case 'tw':
             $conf = require LINKPHP_PATH . 'Lang/tw.Lang.php';
             break;
         case 'en':
             $conf = require LINKPHP_PATH . 'Lang/en.Lang.php';
             break;
         default:
             $conf = require LINKPHP_PATH . 'Lang/cn.Lang.php';
             break;
     }
     return $conf[$language];
 }
 
 //打印函数
 function dump($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
 }
 
 //封装多维数组转换为一维数组方法
 function arr($arr){
    static $array = array();
    //对传入的数组进行遍历
    foreach($arr as $value){
        //判断是否为数组
        if(is_array($value)){
            arr($value);
        } else {
            $array[] = $value;
        }
    }
    return $array;
 }
 

?>