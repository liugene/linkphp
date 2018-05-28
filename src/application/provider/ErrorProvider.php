<?php

namespace app\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\error\Error;

class ErrorProvider implements  EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        Error::register(
            Error::instance()
                ->setErrorView(EXTRA_PATH . 'tpl/error.html')
                ->setDebug(true)
                ->setErrHandle('app\\exception\\Handle')
        )->complete();
        return $definition;
        // TODO: Implement update() method.
    }
}
