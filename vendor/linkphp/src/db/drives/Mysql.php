<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            LinkPHP框架Mysql数据库操作类           *
 * --------------------------------------------------*
 */

/**
 * @param $_host [string] MySQL数据库地址
 * @param $_port [int] MySQL数据库地址端口号
 * @param $_dbuser [string] MySQL数据库用户名
 * @param $_dbpwd [string] MySQL数据库用户密码
 * @param $_charset [string] MySQL数据库字符集
 * @param $_dbname [string] MySQL数据库名
 * @param $_sql [string] 执行的sql
 * @param $result [string] MySQL连接资源集
 */

namespace link\db\drives;
class Mysql
{

    private $_host;
    private $_port;
    private $_dbuser;
    private $_dbpwd;
    private $_charset;
    private $_dbname;
    private $_sql;
    //设置是否开启调试
    static $_debug;

    //连接结果
    private $_result;

    //构造数据库连接方法
    public function __construct($config)
    {

        $this->_host = $config['host'];
        $this->_port = $config['port'];
        $this->_dbuser = $config['dbuser'];
        $this->_dbpwd = $config['dbpwd'];
        $this->_charset = $config['charset'];
        $this->_dbname = $config['dbname'];
        static::$_debug = C('APP_DEBUG');
        //连接数据库
        $this->connect();
        
    }

    //这里进行连接
    public function connect()
    {
        $this->_result = mysqli_connect($this->_host, $this->_dbuser, $this->_dbpwd, $this->
            _dbname, $this->_port);
        if (mysqli_connect_error($this->_result)) {
            trigger_error('数据库连接失败');
        }
        //设置连接编码
        $this->setCharset($this->_charset);
        //选定数据库
        $this->selectDb($this->_dbname);
    }
    //设置数据库编码
    public function setCharset($charset)
    {
        mysqli_set_charset($this->_result, $this->_charset);
    }
    //选择数据库操作
    public function selectDb($dbname)
    {
        mysqli_select_db($this->_result, $this->_dbname);
    }
    //数据库查询操作
    public function query($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = mysqli_query($this->_result, $this->_sql);
            if (!$result) {
                $this->getError("SQL语句执行失败", $this->_sql);
            }
        }
        return $result;
    }

    //条件查询语句封装方法返回所有数据
    /**
     * 
     */
    public function select($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = $this->getAll($this->_sql);
            if (!$result) {
                $this->getError("查询执行失败", $this->_sql);
            }
        }
        return $result;
    }

    //条件查询语句封装方法返回一个数据
    public function find($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = $this->getOne($this->_sql);
            if (!$result) {
                $this->getError("查询执行失败", $this->_sql);
            }
        }
        return $result;
    }

    //条件更新语句封装方法
    public function update($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = $this->query($this->_sql);
            if (!$result) {
                $this->getError("更新执行失败", $this->_sql);
            } else {
                $result = $this->getId();
            }
        }
        return $result;
    }

    //条件删除语句封装方法
    public function delect($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = $this->query($this->_sql);
            if (!$result) {
                $this->getError("删除执行失败", $this->_sql);
            } else {
                $result = $this->getId();
            }
        }
        return $result;
    }

    //调价添加语句封装方法
    public function insert($sql)
    {
        if ($sql == '') {
            $this->getError('SQL语句为空');
        } else {
            $this->_sql = $sql;
            $result = $this->query($this->_sql);
            if (!$result) {
                $this->getError("SQL插入执行失败", $this->_sql);
            } else {
                $result = $this->getId();
            }
        }
        return $result;
    }

    //获得所有查询结果
    public function getAll($sql)
    {
        $result = $this->query($sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    //获得一行
    public function getOne($sql)
    {
        $result = $this->query($sql);
        if(!$result){
            return false;
        }
        return $result = mysqli_fetch_assoc($result);
    }

    //获取最近一次SQL操作语句ID
    public function getId()
    {
        $result = mysqli_insert_id($this->_result);
        return $result;
    }

    //获取查询到的总记录数
    public function getCount($result)
    {
        $result = mysqli_num_rows($result);
        return $result;
    }

    //释放结果集
    public function free()
    {
        @mysqli_free_result();
    }

    //获取错误信息方法
    public function getError($message = '', $sql = '')
    {
        if (static::$_debug == 'TRUE') {
            if (!$sql) {
                echo $message;
            } else {
                echo $message . "<br />";
                echo "错误原因：" . mysqli_error($this->_result) . "<br />";
                echo "执行错误语句:" . $sql . "<br />";
            }
        }
    }

    //析构函数，自动关闭数据库连接，垃圾回收机制
    public function __destruct()
    {
        if (isset($result)) {
            $this->free($result);
        }
        mysqli_close($this->_result);
    }
}
