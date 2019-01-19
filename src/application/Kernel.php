<?php

namespace app;

use framework\Kernel as RouterKernel;

class Kernel extends RouterKernel
{

    public function start($config = null)
    {
        // TODO: Implement request() method.
        $this->app->event('error');
        $this->app->event('router');
        // TODO: Implement response() method.
        // TODO: Implement use() method.
        /**
         * 设置应用启动中间件并监听执行
         */

        $this->app->hook('appMiddleware');
        $this->app->get(\linkphp\router\Router::class)
            ->setPath(
                $this->app->input('server.REQUEST_URI'))
            ->setGetParam(
                $this->app->input('get.'))
            ->setMethod(
                $this->request->getRequestMethod()
            )
            ->parser()
            ->dispatch();
        return $this;
    }

    public function complete()
    {
        $this->app->hook('destructMiddleware');

        parent::beforeComplete();

        $this->request->setData($this->data)->send();
    }

}