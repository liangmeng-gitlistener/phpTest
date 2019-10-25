<?php
namespace core\lib;
use core\lib\conf;
/**
 * 路由类
 * Class route
 * @package core\lib
 */
class route {

    public $ctrl;
    public $action;
    /**
     * 1. 隐藏index.php
     * 2. 获取URL参数部分
     * 3. 返回对应的控制器和方法
     * 此方法暂不考虑超过2个/分割符的url
     * 若想返回自定义方法，必须要有自定义控制器
     */
    public function __construct()
    {
        $path = $_SERVER['REQUEST_URI'];
        if (isset($path)  && $_SERVER['REQUEST_URI'] != '/') {
            $patharr = explode('/', trim($path, '/'));
            if (isset($patharr[0])) {
                if ($this->__paramNum($patharr[0]) == 0) {
                    $this->ctrl = $patharr[0];
                } else {
                    //  处理url中的参数部分
                    //  url多余部分转化为GET请求
                    $ctrlArr = explode('?', trim($patharr[0], '?'));
                    //  此处暂不考虑url中包含多个?的情况
                    if (count($ctrlArr) > 2) {
                        return false;
                    }
                    $this->ctrl = $ctrlArr[0];

                    $paramArr = $this->__getParam($ctrlArr[1]);
                    p($paramArr);
                }
                //此处方便后续url解析，删掉数组中已解析的部分
                unset($patharr[0]);
            }
            if (isset($patharr[1])) {
                if ($this->__paramNum($patharr[1]) == 0) {
                    $this->action = $patharr[1];
                } else {
                    //  处理url中的参数部分
                    //  url多余部分转化为GET请求
                    $actionArr = explode('?', trim($patharr[1], '?'));
                    //  此处暂不考虑url中包含多个?的情况
                    if (count($actionArr) > 2) {
                        return false;
                    }
                    $this->action = $actionArr[0];

                    $paramArr = $this->__getParam($actionArr[1]);
//                    p($paramArr);
                }
                unset($patharr[1]);
            } else {
                $this->action = conf::get('ACTION','route');
            }

        } else {
            $this->ctrl = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }
    }

    /**
     * 判断url中参数个数
     * @param $string
     * @return int
     */
    public function __paramNum($string) {
        $stringArr = explode('?', trim($string, '?'));
        if (isset($stringArr[1])) {
            $paramArr = explode('&', trim($string, '&'));
            return sizeof($paramArr);
        }
        return 0;
    }

    /**
     * 此方法入参必须是url的?后的参数
     * 返回一个数组，数组为get请求参数及其值
     * @param $string
     * @return mixed
     */
    public function __getParam($string) {
        $paramArr = explode('&', trim($string, '&'));
        for ($i = 0; $i < count($paramArr); $i++) {
            $getArr = explode('=', trim($string, '='));
            if (2 == count($getArr)) {
                $_GET[$getArr[0]] = $getArr[1];
            }
        }
        return $_GET;
    }
}