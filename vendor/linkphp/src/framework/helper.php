<?php

use linkphp\Application;

if (!function_exists('error')) {
    function error($url,$info=null,$wait=3)
    {
        if (is_null($info)){
            header('location:' . $url);
        } else{
            //提示后，refresh：N;URL=$URL
            header("Refresh:$wait;URL=$url");
            echo $info;
        }
        die;
    }
}

if (!function_exists('config')) {
    /**
     * 获取配置信息
     * @param string $key
     * @return Config
     */
    function config($key='')
    {
    return $key=='' ? Application::get('linkphp\boot\Config') : Application::get('linkphp\boot\Config')->get($key);
    }
}

if (!function_exists('url')) {
    /**
     * U方法自动生成URL
     * @param $c [string] 需要设置跳转的控制器 默认为空获取当前控制器名
     * @param $a [string] 需要设置跳转的方法名 默认为空获取当前方法名
     * @param $p [string] 需要设置跳转的模块名 默认为空获取当前的模块名
     * @return url [string] 返回拼接好的URL跳转地址
     */
    function url($c=null,$a=null,$p=null)
    {
        $platform = isset($_GET[config('VAR_PLATFORM')]) ? ucfirst($_GET[config('VAR_PLATFORM')]) : config('DEFAULT_PLATFORM');
        $p = is_null($p) ? $platform : $p;
        $c = is_null($c) ? $_GET[config('VAR_CONTROLLER')] : ucfirst($c);
        $a = is_null($a) ? $_GET[config('VAR_ACTION')] : ucfirst($a);
        $url = 'index.php?' . config('VAR_PLATFORM') . '=' . $p . '&' . config('VAR_CONTROLLER') . '=' . $c . '&' . config('VAR_ACTION') . '=' . strtolower($a);

        return $url;
    }
}

if (!function_exists('request')) {
    /**
     * @return HttpRequest
     */
    function request()
    {
        return Application::get('linkphp\\boot\\http\\Restful')->request();
    }
}

if (!function_exists('input')) {
    /**
     * @param string $param
     * @param string|callback $filter
     * @return mixed
     */
    function input($param='',$filter='')
    {
        return Application::get('linkphp\\boot\\http\\Restful')->request()->input($param,$filter);
    }
}

if (!function_exists('lang')) {
    /**
     * @param string $language
     * lang方法 获取系统语言包
     * @return string
     */
    function lang($language){
        switch(C('DEFAULT_LANGUAGE')){
            case 'cn':
                $conf = require INC_PATH . 'Lang/cn.php';
                break;
            case 'tw':
                $conf = require INC_PATH . 'Lang/tw.php';
                break;
            case 'en':
                $conf = require INC_PATH . 'Lang/en.php';
                break;
            default:
                $conf = require INC_PATH . 'Lang/cn.php';
                break;
        }
        return $conf[$language];
    }
}

if (!function_exists('dump')) {
    /**
     * @param mixed $var
     */
    function dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
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