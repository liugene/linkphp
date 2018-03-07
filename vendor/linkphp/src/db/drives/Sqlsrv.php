<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *            Sql server srv数据库扩展类             *
 * --------------------------------------------------*
 */
namespace link\db\drives;
class Sqlsrv
{
    /**
     * @param [sreing] $_host 数据库地址
     */
    private $_host;
    /**
     * @param [sreing] $_dbname 数据库名
     */
    private $_dbname;
    /**
     * @param [sreing] $_dbuser 数据库用户名
     */
    private $_dbuser;
    /**
     * @param [sreing] $_dbpwd 数据库密码
     */
    private $_dbpwd;
    /**
     * @param [int] $_dbport 数据库端口
     */
    private $_port;
    /**
     * @param [sreing] $_charset 数据库字符集
     */
    private $_charset;
    /**
     * @param [sreing] $_dbprefix 数据库表前缀
     */
    private $_dbprefix;
    /**
     * @param [sreing] $_result 数据库链接结果资源
     */
    private $_result;

    public function __construct($config)
    {
        $this->_host = $config['host'];
        $this->_dbname = $config['dbname'];
        $this->_dbuser = $config['dbuser'];
        $this->_dbpwd = $config['dbpwd'];
        $this->_port = $config['port'];
        $this->_charset = $config['charset'];
        $this->_dbprefix = $config['dbprefix'];

        $this->connect();
    }

    //数据库链接方法
    public function connect()
    {
        $info = array("UID"=>$this->_dbuser,"PWD"=>$this->_dbpwd,"DataBase"=>$this->_dbname);
        $this->_result = sqlsrv_connect($this->_host,$info);
        if($this->_result == 'false')
        {
            echo '数据库链接失败';
        }
    }

    //数据库设置字符集
    private function setCharSet()
    {
    }

    //数据库查询方法
    public function query($sql)
    {
        $result = sqlsrv_query($this->_result,$sql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        return $result;
    }

    //find获取单条数据查询方法
    public function find($sql)
    {
        $result = $this->getOne($sql);
        return $result;
    }

    //select获取全部数据查询方法
    public function select($sql)
    {
        $result = $this->getAll($sql);
        return $result;
    }

    //获取所有数据
    public function getAll($sql)
    {
        $result = $this->query($sql);
        $arr = array();
        //$num = $this->getNum($result);
        //var_dump($num);
        while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
        {
            //if(!$)
            $arr[] = $row;
        }
        $result = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
        return $arr;
    }

    //获取一条数据
    public function getOne($sql)
    {
        $result = $this->query($sql);
        $result = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
        return $result;

    }

    //获取取得到的数据总行数
    public function getNum($result)
    {
        $num = sqlsrv_num_rows($result);
        return $num;
    }

    //释放资源
    private function free()
    {

    }


    //数据库操作完自动执行析构函数
    //释放资源
    //关闭数据库链接
    public function __destruct()
    {
        $this->free();
        sqlsrv_close($this->_result);
    }

}
