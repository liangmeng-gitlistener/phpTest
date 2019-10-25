<?php
namespace core\lib;
/**
 * 1.确定存储方式
 * 2.写日志
 * Class log
 * @package core\lib
 */
class log {
    static $class;

    static public function init() {
        $driver = conf::get('DRIVER', 'log');
        $class = DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'driver'.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$driver;
        self::$class = new $class;
    }

    static public function log($message,  $fileName = 'log') {
        self::$class->log($message, $fileName);
    }
}