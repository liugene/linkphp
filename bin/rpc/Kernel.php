<?php

namespace bin\phprpc;

use framework\Kernel as PhpRpcKernel;

class Kernel extends PhpRpcKernel
{

    public function use($config = null)
    {
        // TODO: Implement request() method.
        $this->app->event('error');
        // TODO: Implement use() method.
        $this->app->make(\linkphp\console\Console::class)
            ->setDaemon(true)
            ->setDaemonConfig($config);
        /**
         * 设置应用启动中间件并监听执行
         */
        app()->hook('appMiddleware');
        $this->app->event('console');
        // TODO: Implement response() method.
        return $this;
    }

    public function complete()
    {
        $httpRequest = $this->app->make(\linkphp\http\HttpRequest::class);
        return $httpRequest->setData($this->data)->send(true);
        // TODO: Implement complete() method.
    }

}