<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *              LinkPHP框架项目中的工厂类            *
 * --------------------------------------------------*
 */

class factory{
    
    /**
     * 生成模型的实例对象
     * @param $model_name string
     * @param object
     */
    
    public static function M($model_name){
        
        static $model_list = array();
        //存储已经存在的实话的的模型对象列表，下表模型名，值模型对象
        //判断当前模型是否已经实例化
        
        if(!isset($model_list[$model_name])){
            //没有实例化过
            $model_list[$model_name] = new $model_name;
            //
        }
        return $model_list[$model_name];
        
    }
}

?>