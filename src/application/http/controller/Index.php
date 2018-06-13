<?php

namespace app\http\controller;

use Closure;

class Index
{
    public function handle(Closure $next)
    {
        dump('middleware index');
        return $next;
    }
}
