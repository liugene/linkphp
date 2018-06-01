<?php

namespace bin\console;

use linkphp\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    public function use($config = null)
    {
        // TODO: Implement request() method.
        $this->_app->event('error');
        // TODO: Implement use() method.
        if(isset($config)){
            $this->_app->make(\linkphp\console\Console::class)
                ->setDaemon(true)
                ->setDaemonConfig($config);
        }
        $this->_app->event('console');
        // TODO: Implement response() method.
        /**
         * 设置应用启动中间件并监听执行
         */
        $this->_app->hook('appMiddleware');
        return $this;
    }

    public function complete()
    {
        $this->_app->hook('destructMiddleware');
        $httpRequest = $this->_app->make('linkphp\http\HttpRequest');
        $httpRequest->setRequestHttpAccept('console');
        $httpRequest->setData($this->data)->send();
        // TODO: Implement complete() method.
    }

}