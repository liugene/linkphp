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

namespace linkphp\system\db;
use linkphp\system\db\Drives;
class Db
{
    protected $_dao; //存储dao对象的属性，可以在子类中进行访问，使用dao对象
    protected $_function=array(
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

    protected function _initDAO(){

        //初始化mySQL
        $config = require(LOAD_PATH . 'database.php');
        if(!isset($this->_dao)){
            $dao = Drives::init($config);
            $dao->connect();
            $this->_dao = $dao;
        }
        return $this->_dao;
    }

    public function __construct(){

        //初始化DAO
        $this -> _initDAO();
    }

    public function __call($function,$args)
    {
        if(array_key_exists($function,$this->_function)){
            $this->_function[$function] = $args[0];
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
        $sql = 'select ' . $this->_function['field'] . ' from ' . $this->_function['table'] . ' ' . $this->_function['where'];
        $result = $this->_dao->select($sql);
        $this->freeFunc();
        return $result;
    }

    /**
     * 数据库查询语句解析方法
     * 返回对应一条相关数组
     */
    public function find()
    {
        $sql = 'SELECT ' . $this->_function['field'] . ' FROM ' . $this->_function['table'] . ' ' . $this->_function['where'];
        $result = $this->_dao->find($sql);
        $this->freeFunc();
        return $result;
    }

    public function update(){}

    public function deleted(){}

    public function add($value)
    {
        $sql = 'INSERT INTO ' . $this->_function['table'] . '(' . $this->_function['field']  . ') ' . 'VALUES(' . $value . ') ' . $this->_function['where'];
        $result = $this->_dao->query($sql);
        $this->freeFunc();
        return $result;
    }

    private function freeFunc()
    {
        $this->_function = array(
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

}

?>