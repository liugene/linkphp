<?php

namespace app\ws\controller;

use linkphp\swoole\websocket\WebSocketInterface;
use swoole_http_response;
use swoole_websocket_server;
use swoole_http_request;
use swoole_server;
use swoole_websocket_frame;

class Handle implements WebSocketInterface
{

    public function chat()
    {
        return view('ws/chat');
    }

    public function HandShake(swoole_http_request $request, swoole_http_response $response)
    {
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function open(swoole_websocket_server $svr, swoole_http_request $req)
    {
        echo "server: open success with fd{$req->fd}\n";
    }

    public function message(swoole_server $server, swoole_websocket_frame $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server");
    }

    public function close($ser, $fd)
    {
        echo "client {$fd} closed\n";
    }

}