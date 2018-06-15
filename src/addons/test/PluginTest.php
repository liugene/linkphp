<?php

namespace addons\test;

use linkphp\addons\Addons;

class PluginTest extends Addons
{

    protected $info = [
        'name'          => 'Test',
        'title'         => '测试插件',
        'description'   => '用于linkphp的插件扩展演示',
        'status'        => 1,
        'author'        => 'byron liugene',
        'version'       => '0.1'
    ];

    public function execute()
    {
        return $this->info;
    }

    public function install()
    {
        // TODO: Implement install() method.
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }

}