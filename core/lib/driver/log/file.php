<?php
namespace core\lib\driver\log;
//  TODO:此处接口无法使用，使用的写法待
//use core\lib\driver\log\instance\Ilog;
//class file implements Ilog {
use core\lib\conf;

class file {
    //  日志存储位置
    public $filePath;
    /**
     * 初始化方法
     * file constructor.
     * @throws \Exception
     */
    public function __construct() {
        $conf = conf::get('OPTION', 'log');
        $this->filePath = $conf['PATH'];
    }

    /**
     * 1.确定文件存储路径
     * 2.写入日志
     * @param $message
     * @param string $fileName
     * @return false|int
     */
    public function log($message, $fileName) {
        if (!is_dir($this->filePath.date('YmdH'))) {
            mkdir($this->filePath.date('YmdH'),'0777', true);
        }
//        $message = '['.date('Y-m-d H:i:s').']  '.$this->json_encodes($message).PHP_EOL;
        $message = '['.date('Y-m-d H:i:s').']  '.json_encode($message).PHP_EOL;
        return file_put_contents($this->filePath.date('YmdH').'/'.$fileName.'.php',
            $message, FILE_APPEND);
    }

    function json_encodes($arr) {
        $parts = array ();
        $is_list = false;
        //Find out if the given array is a numerical array
        $keys = array_keys ( $arr );
        $max_length = count ( $arr ) - 1;
        if (($keys [0] === 0) && ($keys [$max_length] === $max_length )) { //See if the first key is 0 and last key is length - 1
            $is_list = true;
            for($i = 0; $i < count ( $keys ); $i ++) { //See if each key correspondes to its position
                if ($i != $keys [$i]) { //A key fails at position check.
                    $is_list = false; //It is an associative array.
                    break;
                }
            }
        }
        foreach ( $arr as $key => $value ) {
            if (is_array ( $value )) { //Custom handling for arrays
                if ($is_list)
                    $parts [] = json_encodes ( $value ); /* :RECURSION: */
                else
                    $parts [] = '"' . $key . '":' . json_encodes ( $value ); /* :RECURSION: */
            } else {
                $str = '';
                if (! $is_list)
                    $str = '"' . $key . '":';
                //Custom handling for multiple data types
                if (is_numeric ( $value ) && $value<2000000000)
                    $str .= $value; //Numbers
                elseif ($value === false)
                    $str .= 'false'; //The booleans
                elseif ($value === true)
                    $str .= 'true';
                else
                    $str .= '"' . addslashes ( $value ) . '"'; //All other things
                // :TODO: Is there any more datatype we should be in the lookout for? (Object?)
                $parts [] = $str;
            }
        }
        $json = implode ( ',', $parts );
        if ($is_list)
            return '[' . $json . ']'; //Return numerical JSON
        return '{' . $json . '}'; //Return associative JSON
    }
}