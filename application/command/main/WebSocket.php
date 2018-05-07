<?php

namespace app\command\main;

use swoole_websocket_server;
use linkphp\Application;
use linkphp\console\Command;

class WebSocket extends Command
{

    private $webscoket;

    public function configure()
    {
        $this->setAlias('websocket')->setDescription('websocket');
    }

    public function execute()
    {
        $server = new swoole_websocket_server("127.0.0.1", 9502);

        $server->on('open', function($server, $req) {
            Application::get('linkphp\console\command\Output')->writeln("connection open: {$req->fd}\n");
        });

        $server->on('message', function($server, $frame) {
            Application::get('linkphp\console\command\Output')->writeln("received message: {$frame->data}\n");
            $server->push($frame->fd, $frame->data);
        });

        $server->on('close', function($server, $fd) {
            Application::get('linkphp\console\command\Output')->writeln("connection close: {$server}\n");
        });
        $this->webscoket = $server;
        $server->start();
    }

    //操作命名
    public function commandHandle($command) {
        if ($command == 'status') {
            $stats = $this->server->stats();
            Application::get('linkphp\console\command\Output')->writeln("查看状态: {$stats}\n");
            return;
        }
        if ($command == 'restart') {
            $reload = $this->server->reload();
            Application::get('linkphp\console\command\Output')->writeln("重启成功: {$reload}\n");
            return;
        }
        if ($command == 'stop') {
            $this->server->stop() && $this->server->shutdown();
            Application::get('linkphp\console\command\Output')->writeln('成功停止');
            return;
        }
        Application::get('linkphp\console\command\Output')->writeln('Unknown Command');
    }


}