<?php

namespace bin\console;

use linkphp\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    public function request($config = null)
    {
        // TODO: Implement request() method.
        $this->_app->event('error');

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



        $this->_app->hook('destructMiddleware');
    }

}