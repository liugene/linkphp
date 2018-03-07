<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Latham <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               数据库语句解释器
// +----------------------------------------------------------------------

namespace link\db;
use link\db\Drives;
class Db
{

    static private $_self;
    static  protected $_dao; //存储dao对象的属性，可以在子类中进行访问，使用dao对象
    static protected $_function=array(
        'table' => '',
        'group' => '',
        'join' => '',
        'field' => '',
        'where' => '',
        'order' => '',
        'having' => '',
        'select' => '',
        'find' => ''
    );

    /**
     * 初始化DAO
     */

    static  protected function _initDAO()
    {
        if(isset(static::$_self)){
            return static::$_self;
        } else {
            static::$_self = new self;
        }
        //初始化mySQL
        $config = require(LOAD_PATH . 'database.php');
        if(!isset(static::$_dao)){
            $dao = Drives::init($config);
            $dao->connect();
            static::$_dao = $dao;
        }
        return static::$_self;
    }
    private function __construct(){}

    private function __clone(){}

    public function __call($function,$args)
    {
        if(array_key_exists($function,static::$_function)){
            static::$_function[$function] = $args[0];
        } else {
            throw new \Exception('无法找到对应方法');
        }
        return $this;
    }

    /**
     * 数据库查询语句解析方法
     * 返回对应所有相关数组
     */
    public function select()
    {
        $sql = 'select ' . static::$_function['field'] . ' from ' . static::$_function['table'] . ' ' . static::$_function['where'];
        $result = static::$_dao->select($sql);
        $this->freeFunc();
        return $result;
    }

    /**
     * 数据库查询语句解析方法
     * 返回对应一条相关数组
     */
    public function find()
    {
        $sql = 'SELECT ' . static::$_function['field'] . ' FROM ' . static::$_function['table'] . ' ' . static::$_function['where'];
        $result = static::$_dao->find($sql);
        $this->freeFunc();
        return $result;
    }

    public function update(){}

    public function deleted(){}

    public function insert($data)
    {
        if(is_array($data)){
            //是数组将键名以及值用','拼接成字符串形式
            $value = implode('\',\'', array_values($data));
            $fileds = implode(',', array_keys($data));
            //拼接数据库插入语句
            $sql = "INSERT INTO " . static::$_function['table'] . " ( $fileds ) VALUES ( '$value' )";
        } else {
            //字段为字符串是直接拼接数据库插入语句
            $sql = "INSERT INTO " . static::$_function['table'] . " ( array_keys($data) ) VALUES ( '".array_values($data)."')";
        }
        $result = static::$_dao->insert($sql);
        return $result;
    }

    public function add($value)
    {
        $sql = 'INSERT INTO ' . static::$_function['table'] . '(' . static::$_function['field']  . ') ' . 'VALUES(' . $value . ') ' . static::$_function['where'];
        $result = static::$_dao->query($sql);
        $this->freeFunc();
        return $result;
    }

    private function freeFunc()
    {
        static::$_function = array(
            'table' => '',
            'group' => '',
            'join' => '',
            'field' => '',
            'where' => '',
            'order' => '',
            'having' => '',
            'select' => '',
            'find' => ''
        );
    }

    // 调用驱动类的方法
    public static function __callStatic($method, $params)
    {
        if(array_key_exists($method,static::$_function)){
            static::$_function[$method] = $params[0];
        } else {
            throw new \Exception('无法找到对应方法');
        }
        // 自动初始化数据库
        return self::_initDAO();
    }

}
