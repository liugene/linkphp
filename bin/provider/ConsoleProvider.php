<?php

namespace bin\provider;

use linkphp\event\EventDefinition;
use linkphp\event\EventServerProvider;
use linkphp\Exception;
use linkphp\Application;

class ConsoleProvider implements  EventServerProvider
{
    public function update(EventDefinition $definition)
    {
        /**
         * 设置应用启动中间件并监听执行
         */
        Application::hook('appMiddleware');
        Application::httpRequest()
            ->setCmdParam(
                Application::input('server.argv')
            );
        Application::make(\linkphp\console\Console::class)
            ->import(
                require LOAD_PATH . 'command.php'
            )->init();
        return $definition;
        // TODO: Implement update() method.
    }
}
