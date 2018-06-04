<?php

namespace bin;

use Closure;

class BinTest
{

    public function handle(Closure $next)
    {
        dump('middleware bin test');
        return $next;
    }

}