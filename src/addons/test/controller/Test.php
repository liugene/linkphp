<?php

namespace addons\test\controller;

use linkphp\http\HttpRequest;

class Test
{

    public function main($id,$test,HttpRequest $httpRequest)
    {
        dump($id);
        dump($test);
        dump($httpRequest);
    }

}