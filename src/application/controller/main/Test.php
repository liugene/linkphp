<?php

namespace app\controller\main;

use Closure;

class Test
{
    public function handle(Closure $next)
    {
        dump('middleware test');
        return $next;
    }
}
