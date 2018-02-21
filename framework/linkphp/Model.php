<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                   Model基础模型类                 *
 * --------------------------------------------------*
 */
 
 namespace linkphp;
 use link\orm\Db;
 class Model extends Db
 {

     /**
      * @param $tbname [string] 数据表名称，不需要传入表前缀
      * @param $fileds [string][array] 数据表字段 可以传入字符串以及数组传入数组时值不需要传入
      * @param $value [string] 数据表插入值 当字段为数组时，该值无需传入
      * @return int 返回数据语句执行结果影响的表ID
      */
     //save 数据库添加操作方法 返回保存记录的ID
     public function save($tbname,$fileds=null,$value=null){
                //将传入的表名用C方法在配置获取表前缀自动添加
        $tbname = C('DBPREFIX') . $tbname;
        //判断传入的字段是否为数组
        if(is_array($fileds)){
            //是数组将键名以及值用','拼接成字符串形式
                $value = implode('\',\'', array_values($fileds));
                $fileds = implode(',', array_keys($fileds));
                //拼接数据库插入语句
                $sql = "INSERT INTO $tbname ( $fileds ) VALUES ( '$value' )";
        } else {
            //字段为字符串是直接拼接数据库插入语句
            $sql = "INSERT INTO $tbname ( $fileds ) VALUES ( \"$value\" )";
        }
        $result = $this->_dao->insert($sql);
        //返回数据语句执行结果影响的表ID
        return $result;
     }


     
     //数据库删除delect方法
     public function delect(){
        $sql = "";
        $this->_dao->delect($sql);
     }
     
     //将查询的所有结二维数组结果转换为一维数组，键名为字段ID 键值为字段值
     public function getNewArr($array){
        foreach($array as $value){
            $key = array_keys($value);
            foreach($key as $kv){
                $arr[$kv][] = $value[$kv];
            }
        }
        return $arr;
     }
     
     
    
 }



?>