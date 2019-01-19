<?php

namespace bin\console;

use framework\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    public function start($config = null)
    {
        // TODO: Implement request() method.
        $this->app->event('error');
        // TODO: Implement use() method.
        $this->app->event('console');
        // TODO: Implement response() method.
        return $this;
    }

    public function complete()
    {
        $httpRequest = $this->app->make('linkphp\http\HttpRequest');
        $httpRequest->setRequestHttpAccept('console');
        $httpRequest->setData($this->data)->send();
        // TODO: Implement complete() method.
    }

}