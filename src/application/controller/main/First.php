<?php

namespace app\controller\main;

use Closure;

class First
{
    public function handle(Closure $next)
    {
        dump('middleware first');
        return $next;
    }
}
