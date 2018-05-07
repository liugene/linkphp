<?php

use links\Links;
use links\server\WebSocket;

require './vendor/autoload.php';

Links::run()->server(
    (new WebSocket('0.0.0.0','81'))
)->start();
