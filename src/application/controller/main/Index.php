<?php

namespace app\controller\main;

use Closure;

class Index
{
    public function handle(Closure $next)
    {
        dump('middleware index');
        return $next;
    }
}
