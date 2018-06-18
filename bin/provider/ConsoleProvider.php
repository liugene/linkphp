<?php

namespace bin\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;

class ConsoleProvider implements  EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        app()->make(\linkphp\console\Console::class)
            ->import(
                require LOAD_PATH . 'command.php'
            )->init();
        return $definition;
        // TODO: Implement update() method.
    }
}
