<?php

namespace bin\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\Exception;
use linkphp\Application;

class DaemonProvider implements  EventServerProvider
{

    public function update(EventDefinition $definition)
    {
        Application::httpRequest()
            ->setCmdParam(
                Application::input('server.argv')
            );
        Application::make(\linkphp\console\Console::class)->init();
        return $definition;
        // TODO: Implement update() method.
    }

}