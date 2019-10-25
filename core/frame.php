<?php
namespace core;
class frame {
    public static $classMap = array();
    public $assign;

    static public function run() {
        $logNew = DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'log';
        $logNew::init();
//        $logNew::log($_SERVER,'server');
        $routeNew = DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'route';
        $route = new $routeNew();
//        p($route);exit;     调试使用
        $ctrlClass = $route->ctrl;
        $action = $route->action;
        $ctrlFileInclude = APP.'/ctrl/'.$ctrlClass.'Ctrl.php';
        $ctrlFileNew = DIRECTORY_SEPARATOR.MODULE.DIRECTORY_SEPARATOR.'ctrl'.DIRECTORY_SEPARATOR.$ctrlClass.'Ctrl';
//        p($ctrlFile);exit;        调试用
        if (is_file($ctrlFileInclude)) {
            include $ctrlFileInclude;
            $ctrl = new $ctrlFileNew();
            $ctrl -> $action();
            $logNew::log('ctrl: '.$ctrlClass.'    '.'action: '.$ctrlClass);
        } else {
            throw new \ Exception("找不到控制器".$ctrlClass);
        }
    }

    // 自动加载
    static public function load($class) {
        /**由于spl_autoload_register逻辑为仅仅在未加载时才调用
         * 故而此处if判断代码冗余，仅作参考
         */
//        p($class);
//        p(LOCATION."/".$class.'.php');
        if (isset($classMap[$class])) {
            return true;
        } else {
            //将\替换为/
            $class = str_replace('\\','/',$class);
//            $file = LOCATION."/".$class.'.php';
            $file=$class.'.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    public function assign($name, $value) {
        $this-> assign[$name] = $value;
    }

    /**
     * 原生PHP写法
     * @param $file
     */
//    public function display($file) {
//        $file = APP."/views/".$file;
//        if (is_file($file)) {
//            extract($this-> assign);
//            include $file;
//        }
//    }

    /**
     * 使用twig模板
     * @param $fileName
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function display($fileName) {
        $file = APP."/views/".$fileName;
        if (is_file($file)) {
//            extract($this-> assign);

            \Twig_Autoloader::register();
            $loader = new \Twig\Loader\FilesystemLoader(APP.'/views');
            $twig = new \Twig\Environment($loader, array(
                'cache' => LOG.'/twig',
                'debug' => DEBUG
            ));
            $template = $twig->load($fileName);
//            $template = $twig->loadTemplate($fileName);
            $template->display($this->assign?$this->assign:'');
        }
    }
}