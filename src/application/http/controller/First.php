<?php

namespace app\http\controller;

use Closure;

class First
{
    public function handle(Closure $next)
    {
        dump('middleware first');
        return $next;
    }
}
