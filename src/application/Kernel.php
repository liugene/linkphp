<?php

namespace app;

use linkphp\Kernel as RouterKernel;

class Kernel extends RouterKernel
{

    public function request($config = null)
    {
        // TODO: Implement request() method.
        $this->_app->event('error');
        $this->_app->event('router');
        // TODO: Implement response() method.
        /**
         * 设置应用启动中间件并监听执行
         */
        $this->_app->hook('appMiddleware');
        $this->_app->get(\linkphp\router\Router::class)
            ->setPath(
                $this->_app->input('server.PATH_INFO')
            )->setGetParam($this->_app->input('get.'))
            ->parser()
            ->dispatch();

        $this->_app->hook('destructMiddleware');
    }

}