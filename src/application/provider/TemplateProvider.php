<?php

namespace app\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\template\View;

class TemplateProvider implements  EventServerProvider
{

    public function update(EventDefinition $eventDefinition)
    {
        $view = new View(app()->get(\linkphp\http\HttpRequest::class),[]);
        $view->engine();
        $view->config(require ROOT_PATH . 'conf/view.php');
        app()->containerInstance(
            'linkphp\template\View',
            $view
        );
        return $eventDefinition;
    }

}