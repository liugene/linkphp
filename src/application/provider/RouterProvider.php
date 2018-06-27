<?php

namespace app\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;

class RouterProvider implements  EventServerProvider
{

    public function update(EventDefinition $definition)
    {
        $router = app()->make(\linkphp\router\Router::class);
        $router->init()
            ->import(require ROOT_PATH . 'src/route.php')
            ->setUrlModel('1')
            ->setDefaultPlatform('http')
            ->setDefaultController('Home')
            ->setDefaultAction('main')
            ->setVarPlatform('m')
            ->setVarController('c')
            ->setVarAction('a')
            ->setRouterOn('true')
            ->setNamespace(APP_NAMESPACE_NAME);
        return $definition;
        // TODO: Implement update() method.
    }

}