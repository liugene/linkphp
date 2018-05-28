<?php

namespace bin\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\error\Error;

class ErrorProvider implements  EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        Error::register(
            Error::instance()
                ->setDebug(true)
                ->setErrHandle('linkphp\\error\\exception\\Console')
        )->complete();
        return $definition;
        // TODO: Implement update() method.
    }
}
