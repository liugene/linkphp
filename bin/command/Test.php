<?php

namespace bin\command;

use framework\Application;
use linkphp\console\Command;

class Test extends Command
{

    public function configure()
    {
        $this->setAlias('test')->setDescription('test');
    }

    public function execute()
    {
        Application::get('linkphp\console\command\Output')->writeln('this is test');
    }

}