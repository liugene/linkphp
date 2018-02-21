<?php

use linkphp\boot\Component;
use linkphp\boot\Definition;

class Container
{

    public function setup()
    {
        Component::bind((new Definition())
            ->setAlias('request')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\http\\Restful')
        );
        Component::bind((new Definition())
            ->setAlias('make')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\Make')
        );
        Component::bind((new Definition())
            ->setAlias('config')
            ->setIsSingleton(true)
            ->setClassName('linkphp\\boot\\Config')
        );
    }

}