<?php

namespace app\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\Exception;
use linkphp\Application;

class RouterProvider implements  EventServerProvider
{

    public function update(EventDefinition $definition)
    {
        /**
         * 设置应用启动中间件并监听执行
         */
        Application::hook('appMiddleware');
        $router = Application::make(\linkphp\router\Router::class);
        $router->init()
            ->run(
                $router->import(require LOAD_PATH . 'route.php')
                    ->set(
                        $router->setUrlModel('1')
                            ->setPath(
                                Application::input('server.PATH_INFO')
                            )
                            ->setDefaultPlatform('main')
                            ->setDefaultController('Home')
                            ->setDefaultAction('main')
                            ->setVarPlatform('m')
                            ->setVarController('c')
                            ->setVarAction('a')
                            ->setRouterOn('true')
                            ->setGetParam(Application::input('get.'))
                            ->setPlatform('')
                            ->setController('')
                            ->setAction('')
                            ->setDir(APPLICATION_PATH)
                            ->setNamespace(APP_NAMESPACE_NAME)
                    )
                    ->parser()
                    ->dispatch()
            );
        return $definition;
        // TODO: Implement update() method.
    }

}