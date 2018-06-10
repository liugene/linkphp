<?php

namespace app\middleware;

use Closure;

class AppTest
{

    public function handle()
    {
        dump('middleware app test');
    }

}