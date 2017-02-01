#### LinkPHP (临克) 是一个免费开源的，快速、简单的面向对象的 轻量级PHP开发框架 ，遵循Apache2开源协议发布。 开发者可以基于LinkPHP框架开发任何免费或者商用项目。

## **使用交流**
LinkPHP开发动态：www.linkphp.cn

使用交流：www.linkphp.cn

技术分享：www.linkphp.cn

BUG反馈：www.linkphp.cn

开发建议：www.linkphp.cn



## **部署条件**
1、PHP版本不能小于5.3版本

## **支持的服务器和数据库环境**

支持Windows/Unix服务器环境
可运行于包括Apache、IIS和nginx在内的多种WEB服务器和模式
框架默认只支持Mysql数据库后期可扩展


##LinkPHP框架目录结构
## **部署目录**

├─index.php        入口文件

├─App                  应用目录

├─Cache               缓存目录

├─Config              站点公共配置

├─Public               资源文件目录

└─LinkPHP           框架目录


## **App目录**
├─App 应用目录
│  ├─Index                 默认模块目录(可配置更换目录名称)
│  │  ├─Conf             模块扩展配置目录
│  │  ├─Controller    控制器目录
│  │  ├─Model          模型目录
│  │  ├─View             视图目录
│  ├─Common          应用公共目录
│  │  ├─Controller    公共控制器目录
│  │  ├─Function      站点公共函数目录
│  │  ├─Model          公共模型目录
│  ├─........           (可自定义添加其他模块目录)
│  │  ├─Conf             模块扩展配置目录
│  │  ├─Controller    控制器目录
│  │  ├─Model          模型目录
│  │  ├─View             视图目录

## **Cache目录**
├─Cachep 缓存目录
│  ├─Log       日志目录
│  ├─SMarty  SMarty模板引擎目录
│  │  ├─Smarty_c     SMarty模板编译目录(可配置修改目录名称)
│  │  ├─Smarty_cache   SMarty模板缓存目录(可配置修改目录名称)

## **Config 目录**
├─Config    应用公共配置目录

## **Public目录**
├─Public    站点公共附件目录(默认为空目录)


## **LinkPHP框架目录**
├─LinkPHP 框架系统目录
│  ├─Conf          核心配置目录 
│  ├─Extend      扩展目录
│  ├─Function   框架公共函数目录
│  ├─Lang         框架语言包目录
│  ├─Link          Link核心类库和工具类库包目录
│  │  ├─Tools    核心工具类库目录
│  ├─Sys            框架核心工具类库扩展目录
│  ├─Template  模板引擎目录
│  ├─TTFF          框架附件目录
│  ├─README.txt   框架README文件
│  └─LinkPHP.php 框架入口文件
