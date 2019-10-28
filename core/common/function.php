<?php

function p($var)
{
    if(is_bool($var)){
        var_dump($var);
    }elseif(is_null($var)){
        var_dump(null);
    }else{
        echo "<pre style=
                        '
                        position:relative;
                        z-index:999;
                        padding:10px;
                        border-radius:5px;
                        background:#ccc;
                        border:1px solid #aaa;
                        font-size:14px;
                        line-height:18px;opacity:0.9;
                        '
                        >".print_r($var,true)."</pre>";
    }
}

/**
 * post接收方法
 * @param $name             对应值
 * @param bool $default   默认值
 * @param bool $filter    过滤方法
 * @return mixed|string
 */
function post($name, $default = false, $filter = false) {
    if (isset($_POST[$name])) {
        if ($filter) {
            switch ($filter) {
                case 'int' :
                    if (is_numeric($_POST[$name])) {
                        return $_POST[$name];
                    } else {
                        return $default;
                    }
                break;
                default: ;
            }
        } else {
            return $_POST[$name];
        }
    } else {
        return $default;
    }
}

/**
 * get接收方法
 * @param $name             对应值
 * @param bool $default   默认值
 * @param bool $filter    过滤方法
 * @return mixed|string
 */
function get($name, $default = false, $filter = false) {
    if (isset($_GET[$name])) {
        if ($filter) {
            switch ($filter) {
                case 'int' :
                    if (is_numeric($_GET[$name])) {
                        return $_GET[$name];
                    } else {
                        return $default;
                    }
                    break;
                default: ;
            }
        } else {
            return $_GET[$name];
        }
    } else {
        return $default;
    }
}

function jump($url) {
    header('Location:'.$url);
    exit;
}