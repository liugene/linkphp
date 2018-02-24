<?php

namespace linkphp\boot\http;

class HttpRequest
{

    private $cmd;

    private $cmd_param = [];

    private $_response;

    private $_input;

    private $queryParam = [];

    //请求方法
    private $request_method;

    //数据
    private $data;

    private $request_http_accept = 'json';

    public function __construct(ResponseDriver $response,Input $input)
    {
        $this->_response = $response;
        $this->_input = $input;
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
        $contentType = $this->server('CONTENT_TYPE');
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
        return $this;
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
        $this->queryParam = array_merge($this->get(),$this->post(),$this->file(),$this->server(),$this->cookie(),$this->env());
        return $this;
    }

    public function get($key='',$filter='')
    {
        return $this->_input->get($key,$filter);
    }

    public function post($key='',$filter='')
    {
        return $this->_input->post($key,$filter);
    }

    public function file($key='')
    {
        return $this->_input->file($key);
    }

    public function server($key='')
    {
        return $this->_input->server($key);
    }

    public function cookie($key='')
    {
        return $this->_input->cookie($key);
    }

    public function env($key='')
    {
        return $this->_input->env($key);
    }

    public function getInput($filter='')
    {
        return $this->_input->getInput($filter);
    }

    public function input($key = '',$filter)
    {
        if ($pos = strpos($key, '.')) {
            // 指定参数来源
            list($method, $key) = explode('.', $key, 2);
            if (in_array($method, ['get', 'post', 'file', 'server', 'cookie', 'env'])) {
                return $this->$method($key,$filter);
            }
        }
        if(empty($this->queryParam)){
            $this->setQueryParam();
        }
        return $key=='' ? $this->queryParam : $this->queryParam[$key];
    }

    public function setCmdParam($command)
    {
        if(is_array($command) && count($command)>1){
            $this->cmd = $command[1];
        }
    }

    public function cmd($key)
    {
        return $this->cmd_param[$key];
    }

}
