<?php

namespace bin;

use Closure;

class AppTest
{

    public function handle(Closure $next)
    {
        dump('middleware app test');
        return $next;
    }

}