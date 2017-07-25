<?php

namespace util\page;
/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                LinkPHP框架分页类                  *
 * --------------------------------------------------*
 */

class Page
{

    /**
     * @param int $_page GET获取分页ID
     * @param int $_total 计算分页总数
     * @param int $_showpage 可选参数默认为10 每页显示的条数
     * @param int $_total_pages 计算当前数据总共分页 ceil($_total/$_showpage) 分页总数除分页条数
     * @param string $uri 自动获取当前地址
     * @return limit 返回limit条件
     * @return string 返回分页条
     */

    private $_page; //获取分页ID
    private $_total; //获取分页数据总数
    private $_showpage; //每页显示数目
    private $_total_pages; //分页数
    private $_uri; //自动获取URL

    function __construct($total, $showpage = 10, $query = "")
    {

        $this->_total = $total;
        $this->_showpage = $showpage;
        $this->_total_pages = ceil($this->_total / $this->_showpage);
        $this->_page = isset($_GET['pageid']) ? $_GET['pageid'] : '1';
        $this->_uri = $this->getUri($query);
    }

    //获取url
    private function getUri($query)
    {
        //获取当前请求URL
        $request_uri = $_SERVER["REQUEST_URI"];
        //匹配当前URL内是否存在? 不存在添加?
        $url = strstr($request_uri, '?') ? $request_uri : $request_uri . '?';
        //判断传入的参数是否为数组
        if (is_array($query)) //是数组

            $url .= http_build_query($query);
        else
            if ($query != "")
                $url .= "&" . trim($query, "?&");

        $arr = parse_url($url);

        if (isset($arr["query"])) {
            parse_str($arr["query"], $arrs);
            unset($arrs["page"]);
            $url = $arr["path"] . '?' . http_build_query($arrs);
        }

        if (strstr($url, '?')) {
            if (substr($url, -1) != '?')
                $url = $url . '&';
        } else {

            $url = $url . '?';
        }

        return $url;
    }

    //设置limit
    public function limit()
    {
        return 'limit ' . ($this->_page - 1) * $this->_showpage . ',' . ($this->
            _showpage);
    }


    //显示首页
    private function first()
    {
        if ($this->_page > 1) {
            $pagebanner = "&nbsp;&nbsp;<a href='{$this->_uri}pageid=1'>首页</a>&nbsp;&nbsp;";
            $pagebanner .= "&nbsp;&nbsp;<a href='{$this->_uri}pageid=" . ($this->_page - 1) .
                "'>上一页</a>&nbsp;&nbsp;";
            return $pagebanner;
        } else {
            $pagebanner = '&nbsp;&nbsp;首页&nbsp;&nbsp;';
            $pagebanner .= '&nbsp;&nbsp;上一页&nbsp;&nbsp;';
            return $pagebanner;
        }
    }


    //显示末页
    private function end()
    {
        if ($this->_page != $this->_total_pages) {
            $pagebanner = "&nbsp;<a href='{$this->_uri}pageid=" . ($this->_page + 1) .
                "'>下一页</a>&nbsp;&nbsp;";
            $pagebanner .= "&nbsp;<a href='{$this->_uri}pageid=" . ($this->_total_pages) .
                "'>末页</a>&nbsp;&nbsp;";
            return $pagebanner;
        } else {
            $pagebanner = '&nbsp;&nbsp;下一页&nbsp;&nbsp;';
            $pagebanner .= '&nbsp;&nbsp;末页&nbsp;&nbsp;';
            return $pagebanner;
        }
    }

    //显示分页
    public function show()
    {
        $page_banner = "总记录数为:{$this->_total} 页数:{$this->_total_pages} " . $this->first() .
            $this->end();
        return $page_banner;
    }
}



?>