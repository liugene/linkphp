<?php

namespace app\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use framework\Application;

class RouterProvider implements  EventServerProvider
{

    public function update(EventDefinition $definition)
    {
        $router = Application::make(\linkphp\router\Router::class);
        $router->init()
            ->import(require ROOT_PATH . 'src/route.php')
            ->setUrlModel('1')
            ->setDefaultPlatform('main')
            ->setDefaultController('Home')
            ->setDefaultAction('main')
            ->setVarPlatform('m')
            ->setVarController('c')
            ->setVarAction('a')
            ->setRouterOn('true')
            ->setPlatform('')
            ->setController('')
            ->setAction('')
            ->setNamespace(APP_NAMESPACE_NAME);
        return $definition;
        // TODO: Implement update() method.
    }

}