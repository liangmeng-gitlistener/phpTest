<?php
namespace app\ctrl;
class conftestCtrl extends \core\frame {
    public function index() {

        $confClass = DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'conf';
        $temp1 = $confClass::get('CTRL', 'route');
        $temp2 = $confClass::get('ACTION', 'route');
        p($temp1);
        p($temp2);
    }
}