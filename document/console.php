<?php

/**
 * 首先请保证已经将执行目录切换到linkphp框架目录，默认执行
 * php cli如果已经将cli文件更换为自定义名称则执行自定义的名称

 * php cli +命令名

 * 系统内置了些许方法可参考手册查找，如果需要自定义命令名则需要做一下几步：

 * 1、在configure目录中打开command.php文件，添加命令类
 * 2、在新增的命令类中按照系统给定的方式进行创建类文件
 * （假如自定义命令类为 app\command\main\Tset）
 */
namespace app\command\main;

use linkphp\Application;
use linkphp\console\Command;

class Test extends Command
{

    public function configure()
    {
        $this->setAlias('test')->setDescription('test');
    }

    public function execute()
    {
        Application::get('linkphp\console\command\Output')->writeln('this is test');
    }

    //如果需要在该命令中添加更多方法则需要集成该方法
    public function commandHandle(){}
}