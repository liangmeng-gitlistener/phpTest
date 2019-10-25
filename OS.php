<?php
define("SEPARATOR_WINNT", "\\");
define("SEPARATOR_LINUX", "/");

/**
 * 此类冗余仅作为娱乐
 * Class OS
 */
class OS {
    public static $separator = "";

    /**
     * 此方法返回值效果等同于DIRECTORY_SEPARATOR
     * @return mixed
     */
    static public function getDirectory() {
        if (PHP_OS == 'WINNT') {
            $separator = "SEPARATOR_WINNT";
        } else {
            $separator = "SEPARATOR_LINUX";
        }
        return constant($separator);
    }
}
