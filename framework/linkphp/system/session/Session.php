<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架session 入库工具类          *
 * --------------------------------------------------*
 */

namespace linkphp\system\session;

use linkphp\boot\Config;

class Session{
    private $_dao;
    
    public function __construct()
    {
        /**
         * 开启session机制
         */
        if(Config::get('session_on')){
            session_start();
        }
        //设置session处理器
        ini_set('session.save_handle','user');
        session_set_save_handler(
            array($this,'userSessionBegin'),
            array($this,'userSessionEnd'),
            array($this,'userSessionRead'),
            array($this,'userSessionWrite'),
            array($this,'userSessionDelete'),
            array($this,'userSessionGC')
        );
    }
    /**
 * @author liujun
 * @copyright 2017
 * session数据表
 * create table if not exists fly_session(
 *   session_id varchar(40) not null default '' comment 'sessionID';
 *   session_content text;
 *   last_time int not null default '0' comment '最后处理时间';
 * primary key(session_id) 
 * )engine=MyISAM default charset=utf8 comment session数据表'';
 */


function userSessionBegin(){
    
}
function userSessionEnd(){
    
}
function userSessionRead($sess_id){
    /**
     * 读操作
     * 执行时机：当session机制开启时
     * 工作：    从session数据区中读取数据
     * @param $sess_id string
     * @return string
     */
     //初始化数据库服务器连接
     //查询
    
}
function userSessionWrite($sess_id,$sess_content){
    /**
     * 更新操作
     * 执行时机：   脚本周期结束时，php在整理收尾时
     * 工作：       将当前脚本处理好的session数据，持久化存储在数据库中
     * @param $sess_id string
     * @param $sess_content text
     * @return bool 
     */
     //初始化数据库服务器连接
     //插入或更新数据
}
function userSessionDelete($sess_id){
    /**
     * 删除操作
     * 执行时机：   调用了session_destroy()销毁session过程中被调用
     * 工作：       删除当前session的数据区（记录）
     * @param $sess_id string
     * @return bool 
     */
     //初始化数据库服务器连接
     //删除语句
    
}
function userSessionGC($sess_id){
     /**
     * 删除数据库session表字段内容操作
     * 执行时机：   最后一次写入操作大于最大存活时间则删除
     * 工作：       删除当前session的数据库字段内容（记录）
     * @param $sess_id string
     * @return bool 
     */
     //初始化数据库服务器连接
     //判断时间执行删除语句
    
}
    
}