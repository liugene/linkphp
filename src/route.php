<?php

Router::get(':id/:test', '/main/home/main');
Router::get('/', '/main/home/main');

return [
//    ':id/:test'   =>  ['/main/home/main',['method' => 'get']],
];