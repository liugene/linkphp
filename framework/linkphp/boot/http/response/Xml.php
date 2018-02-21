<?php

namespace linkphp\boot\http\response;
use linkphp\boot\http\HttpResponse;

class Xml extends HttpResponse
{

    protected $content_type = 'Content-Type:text/xml';

    /**
     * 处理数据
     * @access public
     * @param mixed $data 要处理的数据
     * @return mixed
     */
    public function output($data)
    {
        return $this->xmlEncode($data);
    }

    private function xmlEncode($data)
    {
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .=  "<xml>";
        $xml .= $this->xmlToEncode($data);
        $xml .= "</xml>";
        return $xml;
    }

    private function xmlToEncode($data)
    {
        $xml = "";
        foreach($data as $key => $value){
            $val = is_array($value) ? $this->xmlToEncode($value) : $value;
            $xml = "<{$key}>$val</{$key}>";
        }
        return $xml;
    }

}