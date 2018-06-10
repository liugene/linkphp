<?php

namespace bin\phprpc;

use framework\Kernel as PhpRpcKernel;

class Kernel extends PhpRpcKernel
{

    public function use($config = null)
    {
        // TODO: Implement request() method.
        $this->_app->event('error');
        // TODO: Implement use() method.
        $this->_app->make(\linkphp\console\Console::class)
            ->setDaemon(true)
            ->setDaemonConfig($config);
        /**
         * 设置应用启动中间件并监听执行
         */
        app()->hook('appMiddleware');
        $this->_app->event('console');
        // TODO: Implement response() method.
        return $this;
    }

    public function complete()
    {
        $httpRequest = $this->_app->make(\linkphp\http\HttpRequest::class);
        return $httpRequest->setData($this->data)->send(true);
        // TODO: Implement complete() method.
    }

}