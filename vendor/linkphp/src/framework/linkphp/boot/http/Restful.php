<?php

namespace linkphp\boot\http;

class Restful
{

    /**
     * 单例对象
     * @object object $_instance
     */
    static private $_instance = null;

    /**
     * 请求实例对象
     * @object object $_request
     */
    static private $_request;

    public function __construct()
    {
        //获取请求方式
        $request_method = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : '';
        if(!isset($this->_request)){
            self::$_request = (new HttpRequest(new ResponseDriver(),new Input()))->setRequestMethod($request_method);
        }
    }

    /**
     * 统一请求入口
     * @return object self::$_request
     */
    static public function request()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_request;

    }

}
