<?php

namespace linkphp\boot\http;

class HttpRequest
{

    private $cookie;

    private $env;

    private $server;

    private $_response;

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

    public function getCookie()
    {
        return $this->cookie;
    }

    public function getServer()
    {
        return $this->server;
    }

}
