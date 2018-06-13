<?php

namespace app\http\controller;

use Closure;

class Test
{
    public function handle(Closure $next)
    {
        dump('middleware test');
        return $next;
    }
}
