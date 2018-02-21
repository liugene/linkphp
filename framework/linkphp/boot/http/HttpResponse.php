<?php

namespace linkphp\boot\http;

class HttpResponse
{

    private $status = 200;

    protected $content_type;

    private $response;

    private $header = [];

    public function getResponse()
    {
        return $this->response;

    }

    public function send()
    {
        $status_header = 'HTTP/1.1 ' . $this->status . ' ' . Code::getStatusCodeMsg($this->status);
        if(!headers_sent()){
            //设置header头状态
            header($status_header);
            http_response_code($this->status);
            //设置header 头类型
            header('Content-type: ' . $this->content_type);
        }
        echo $this->response;
        if (function_exists('fastcgi_finish_request')) {
            // 提高页面响应
            fastcgi_finish_request();
        }
        exit;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setContentType($type)
    {
        $this->content_type = $type;
        return $this;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * 设置响应头
     * @access public
     * @param string|array $name  参数名
     * @param string       $value 参数值
     * @return $this
     */
    public function header($name, $value = null)
    {
        if (is_array($name)) {
            $this->header = array_merge($this->header, $name);
        } else {
            $this->header[$name] = $value;
        }
        return $this;
    }

    /**
     * 处理数据
     * @access protected
     * @param mixed $data 要处理的数据
     * @return mixed
     */
    protected function output($data)
    {
        return $data;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getContentType()
    {
        return $this->content_type;
    }
}
