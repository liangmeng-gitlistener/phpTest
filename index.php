<?php
/**
 * 入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */

//  当前框架所在的根目录
define('LOCATION', realpath('.'.DIRECTORY_SEPARATOR));
//define('LOCATION', str_replace('\\','/',dirname(realpath(__FILE__))));
//  框架核心文件所处目录
define('CORE',LOCATION.'/core');
//  项目文件所处目录（控制器&模型...）
define('APP',LOCATION.'/app');
define('LOG',LOCATION.'/log');
define('MODULE', 'app');

define('DEBUG', true);

//使用composer下载的类库需要加入依赖
include "vendor/autoload.php";

if (DEBUG) {
    $whoops = new \Whoops\Run;
    $erroTitle = '系统异常';
    $option = new \Whoops\Handler\PrettyPageHandler();
    $option->setPageTitle($erroTitle);
    $whoops->prependHandler($option);
    $whoops->register();
    ini_set('display_errors','On');
} else {
    ini_set('display_errors','Off');
}

// 加载常用函数库
include CORE.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'function.php';

include CORE.DIRECTORY_SEPARATOR.'frame.php';

//  作用：自动include
//spl_autoload_register('\core\frame::load');
spl_autoload_register(DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'frame::load');

DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.\core\frame::run();
//\core\frame::run();