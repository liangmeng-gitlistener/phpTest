<?php
namespace app\ctrl;
class indexCtrl extends \core\frame {
    public function index() {
        $data = 'hello world!';
        $title = '视图文件';
        $this->assign('data', $data);
        $this->assign('title', $title);
//        $this->display('index.html');
        $this->display('index_twig.html');
    }

    public function test() {
        $data = 'test!';
        $title = '视图文件 TEST';
        $this->assign('data', $data);
        $this->assign('title', $title);
        $this->display('test_twig.html');
    }
}