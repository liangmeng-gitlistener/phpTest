<?php
namespace app\model;
use \core\lib\medooModel;

class guestbookModel extends medooModel {
    public $table_name = 'guest_book';

    public function lists(){
        return $this->select($this->table_name,"*");
    }

    public function getOne($id){
        return $this->get($this->table_name,'*',array(
            'id'=>$id
        ));
    }
    public function updateOne($id,$data){
        return $this->update($this->table_name,$data, array(
            'id'=>$id
        ));
    }
    public function deleteOne($id){
        return $this->delete($this->table_name, array(
            'id'=>$id
        ));
    }

    public function insertData($data) {
        return $this->insert($this->table_name, $data);
    }
}