<?php

namespace linkphp\boot\http;
use linkphp\boot\http\response\Json;
use linkphp\boot\http\response\Xml;

class ResponseDriver
{

    private $_request;

    public function setRequest(HttpRequest $request)
    {
        $this->_request = $request;
    }

    public function getDriver()
    {
        switch($this->_request->getRequestHttpAccept()){
            case 'json';
                $response_driver = new Json();
                break;
            default :
                $response_driver = new Xml();
        }
        return $response_driver;
    }

}
