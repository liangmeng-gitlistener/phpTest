<?php
namespace core\lib;

class conf {

    static public $config;
    /**
     * 1.判断文件是否存在
     * 2.判断配置是否存在
     * 3.缓存配置项
     * @param $name
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    static public function get($name, $file) {
        $path = LOCATION.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$file.'.php';
//        p($file);exit;
        if(isset(self::$config[$file])){
            return self::$config[$file][$name];
        }else {
            if (file_exists($path)) {
                $conf = include $path;
                if (isset($conf[$name])) {
                    self::$config[$file] = $conf;
                    return $conf[$name];
                } else {
                    throw new \ Exception("找不到配置项：" . $name);
                }
            } else {
                throw new \ Exception('找不到配置文件：' . $file);
            }
        }
    }

    static public function getAll($file) {
        $path = LOCATION.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$file.'.php';
//        p($file);exit;
        if(isset(self::$config[$file])){
            return self::$config[$file];
        }else {
            if (file_exists($path)) {
                $conf = include $path;
                self::$config[$file] = $conf;
                return $conf;
            } else {
                throw new \ Exception('找不到配置文件：' . $file);
            }
        }
    }
}