<?php
namespace app\ctrl;
class dbtestCtrl {
    public function index() {
//        $modelNew = DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'model';
//        $model = new $modelNew();
//        $sql = "SELECT * FROM test";
//        $ret = $model->query($sql);
//        p($ret -> fetchAll());
        $model = new \app\model\testModel();
        $data = $model->getOne(1);
        dump($data);
        $data = $model->updateOne(1,array(
            'name'=>'们'
        ));
        dump($data);
//        $data = $model->insertData(array(
//            'name'=>'我们',
//            'sort'=>45
//        ));
//        dump($data);
    }
}