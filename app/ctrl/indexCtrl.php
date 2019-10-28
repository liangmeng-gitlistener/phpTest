<?php
namespace app\ctrl;
use \app\model\guestbookModel;
class indexCtrl extends \core\frame {

    public function common() {
        $dataTitle = '首页';
        $title = '超简单留言板';
        $this->assign('data_title', $dataTitle);
        $this->assign('title', $title);
    }
    /**
     * 查看所有留言的功能
     */
    public function index() {
        $this->common();
        $model = new guestbookModel();
        $data = $model->lists();
        $this->assign('data', $data);
        $this->display('index.html');
    }
    /**
     * 添加留言的功能
     */
    public function add() {
        $this->common();
        $this->display('add.html');
    }
    /**
     * 保存留言的功能
     */
    public function save() {
        $data['title'] = post('title');
        $data['content'] = post('content');
        $data['createtime'] = time();
        $model = new guestbookModel();
        if ($model->insertData($data)) {
            jump('/');
        } else {
            dump('error');
        }
    }

    public function del() {
        $id = get('id','0','int');
        if ($id) {
            $model = new guestbookModel();
            $ret = $model->deleteOne($id);
            if ($ret !== false) {
                //删除成功
                jump('/');
            } else {
                exit('删除失败');
            }
        } else {
            dump('参数错误,$id: '.$id);
        }
    }
}