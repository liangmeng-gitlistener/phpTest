<?php
namespace core\lib;
use core\lib\conf;
class medooModel extends \Medoo\medoo {
    public function __construct(){
        $option = conf::getAll('medooDatabase');
        parent::__construct($option);
    }
}