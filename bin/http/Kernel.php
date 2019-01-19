<?php

namespace bin\http;

use framework\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    public function start($config = null)
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
        $this->app->hook('appMiddleware');
        $this->app->event('console');
        // TODO: Implement response() method.
        return $this;
    }

    public function complete()
    {
        parent::beforeComplete();
        return $this->request->setData($this->data)->send(true);
        // TODO: Implement complete() method.
    }

}