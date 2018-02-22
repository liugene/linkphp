<?php

namespace linkphp\boot\http;

class HttpRequest
{

    private $cookie;

    private $env;

    private $server;

    private $_response;

    private $queryParam = [];

    //请求方法
    private $request_method;

    //数据
    private $data;

    private $request_http_accept = 'json';

    public function __construct(ResponseDriver $response)
    {
        $this->_response = $response;
    }

    public function setData($data)
    {
        $this->data = $data;
        $this->_response->setRequest($this);
        return $this;
    }

    public function setRequestMethod($method)
    {
        $this->request_method = $method;
        $this->_response->setRequest($this);
        return $this;
    }

    public function setRequestHttpAccept($accept)
    {
        $this->request_http_accept = $accept;
        $this->_response->setRequest($this);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getRequestMethod()
    {
        return $this->request_method;
    }

    public function getRequestHttpAccept()
    {
        return $this->request_http_accept;
    }

    /**
     * 响应请求返回response 实例对象
     * @return Object[ResponseDriver] $this->_response
     */
    public function setResponse()
    {
        $this->_response->getDriver()->setResponse($this->_response->getDriver()->output($this->data));

        return $this->_response->getDriver();
    }

    /**
     * 响应请求输出结果
     * @return $this->_request_http_accept
     */
    public function send()
    {
        $this->_response->getDriver()->setResponse($this->_response->getDriver()->output($this->data))->send();
    }

    /**
     * 当前请求 HTTP_CONTENT_TYPE
     * @access public
     * @return string
     */
    public function contentType()
    {
        $contentType = $this->getServer('CONTENT_TYPE');
        if ($contentType) {
            if (strpos($contentType, ';')) {
                list($type) = explode(';', $contentType);
            } else {
                $type = $contentType;
            }
            return trim($type);
        }
        return '';
    }

    public function start()
    {
        $this->cookie = $_COOKIE;
        $this->env = $_ENV;
        $this->server = $_SERVER;
        return $this;
    }

    public function getEnv()
    {
        return $this->env;
    }

    public function getCookie($param)
    {
        return $this->cookie[$param];
    }

    public function getServer($param)
    {
        return $this->server[$param];
    }

    public function isMethod($method)
    {
        return $this->getRequestMethod() === $method;
    }

    public function isGet()
    {
        return $this->isMethod('get');
    }

    public function isPost()
    {
        return $this->isMethod('post');
    }

    public function isDelete()
    {
        return $this->isMethod('delete');
    }

    public function isPut()
    {
        return $this->isMethod('put');
    }

    public function isPatch()
    {
        return $this->isMethod('parch');
    }

    public function isHead()
    {
        return $this->isMethod('head');
    }

    public function isOptions()
    {
        return $this->isMethod('options');
    }

    public function setQueryParam()
    {
        $this->queryParam = array_merge($this->get(),$this->post(),$this->file());
        return $this;
    }

    public function get($key='')
    {
        return $key=='' ? $_GET : $_GET[$key];
    }

    public function post($key='')
    {
        return $key=='' ? $_POST : $_POST[$key];
    }

    public function file($key='')
    {
        return $key=='' ? $_FILES : $_FILES[$key];
    }

    public function input($key = '')
    {
        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            list($method, $key) = explode('.', $key, 2);
            if (in_array($method, ['get', 'post', 'file'])) {
                return $this->$method($key);
            }
        }
        return $this->queryParam[$key];
    }

}
