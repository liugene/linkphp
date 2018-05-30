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
        $router = Application::make(\linkphp\router\Router::class);
        $router->init()
            ->import(require LOAD_PATH . 'route.php')
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
            ->setDir(APPLICATION_PATH)
            ->setNamespace(APP_NAMESPACE_NAME);
        return $definition;
        // TODO: Implement update() method.
    }

}