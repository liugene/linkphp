<?php

namespace app;

use linkphp\Kernel as RouterKernel;

class Kernel extends RouterKernel
{

    public function use($config = null)
    {
        // TODO: Implement request() method.
        $this->_app->event('error');
        $this->_app->event('router');
        // TODO: Implement response() method.
        // TODO: Implement use() method.
        /**
         * 设置应用启动中间件并监听执行
         */
        $this->_app->hook('appMiddleware');
        $this->_app->get(\linkphp\router\Router::class)
            ->setPath(
                $this->_app->input('server.PATH_INFO'))
            ->setGetParam(
                $this->_app->input('get.'))
            ->setMethod(
                $this->_request->getRequestMethod()
            )
            ->parser()
            ->dispatch();
        return $this;
    }

    public function complete()
    {
        $this->_app->hook('destructMiddleware');

        $this->_request->setData($this->data)->send();
    }

}