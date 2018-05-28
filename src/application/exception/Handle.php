<?php

namespace app\exception;

use linkphp\error\ErrorHandle;
use linkphp\error\Error;

class Handle extends ErrorHandle
{

    public function handle(Error $error)
    {
        $data = [
            'file'    => $error->getFile(),
            'line'    => $error->getLine(),
            'error_type' => $error->getErrorType(),
            'message'   => $error->getMessage(),
            'datetime'  => $error->getTimestamp(),
            'trace'    => $error->getTrace()
        ];
        extract($data);
        include($error->getErrorView());
    }

}