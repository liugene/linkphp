<?php

namespace bin\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use framework\Exception;

class DaemonProvider implements  EventServerProvider
{

    public function update(EventDefinition $definition)
    {
        app()->make(\linkphp\console\Console::class)->init();
        return $definition;
        // TODO: Implement update() method.
    }

}