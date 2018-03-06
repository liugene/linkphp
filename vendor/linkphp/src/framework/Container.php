<?php

use linkphp\boot\Component;
use linkphp\boot\Definition;

class Container
{

    static public function setup()
    {
        Component::bind(
            (new Definition())
                ->setAlias('env')
                ->setIsSingleton(true)
                ->setClassName('linkphp\\boot\\Environment')
        );
        Component::bind(
            (new Definition())
            ->setAlias('request')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\http\\Restful')
        );
        Component::bind(
            (new Definition())
            ->setAlias('make')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\Make')
        );
        Component::bind(
            (new Definition())
            ->setAlias('config')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\Config')
        );
        Component::bind(
            (new Definition())
            ->setAlias('middle')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\Middleware')
        );
    }

}